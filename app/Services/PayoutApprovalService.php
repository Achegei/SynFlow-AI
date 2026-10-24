<?php

namespace App\Services;

use App\Models\Institution;
use App\Models\PayoutRequest;
use App\Models\SalesExecutive;
use DomainException;
use Illuminate\Support\Facades\DB;

class PayoutApprovalService
{
    public function approve(PayoutRequest $request, int $adminId): void
    {
        DB::transaction(function () use ($request, $adminId) {
            $payout = PayoutRequest::query()
                ->whereKey($request->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            // A previously approved request must not deduct funds again.
            if ($payout->status === 'approved') {
                return;
            }

            if ($payout->status !== 'pending') {
                throw new DomainException(
                    'Only pending payout requests can be approved.'
                );
            }

            if ((float) $payout->amount <= 0) {
                throw new DomainException(
                    'Payout amount must be greater than zero.'
                );
            }

            $model = match ($payout->requester_type) {
                'institution' => Institution::class,
                'sales_executive' => SalesExecutive::class,
                default => throw new DomainException(
                    'Invalid payout requester type.'
                ),
            };

            $wallet = $model::query()
                ->whereKey($payout->requester_id)
                ->lockForUpdate()
                ->first();

            if (!$wallet) {
                throw new DomainException(
                    'Payout requester no longer exists.'
                );
            }

            if ((float) $wallet->wallet_balance < (float) $payout->amount) {
                throw new DomainException(
                    'Insufficient wallet balance for this payout.'
                );
            }

            $wallet->decrement('wallet_balance', $payout->amount);

            $payout->update([
                'status' => 'approved',
                'approved_by' => $adminId,
                'processed_at' => now(),
            ]);
        }, 3);
    }

    public function reject(PayoutRequest $request): void
    {
        DB::transaction(function () use ($request) {
            $payout = PayoutRequest::query()
                ->whereKey($request->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            if ($payout->status === 'rejected') {
                return;
            }

            if ($payout->status !== 'pending') {
                throw new DomainException(
                    'Only pending payout requests can be rejected.'
                );
            }

            $payout->update([
                'status' => 'rejected',
            ]);
        }, 3);
    }

}
