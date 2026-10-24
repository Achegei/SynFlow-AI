<?php

namespace App\Services;

use App\Models\Institution;
use App\Models\PayoutRequest;
use App\Models\SalesExecutive;
use DomainException;
use Illuminate\Support\Facades\DB;

class PayoutRequestService
{
    public function create(string $requesterType, int $requesterId): PayoutRequest
    {
        return DB::transaction(function () use ($requesterType, $requesterId) {
            $model = match ($requesterType) {
                'institution' => Institution::class,
                'sales_executive' => SalesExecutive::class,
                default => throw new DomainException(
                    'Invalid payout requester type.'
                ),
            };

            $wallet = $model::query()
                ->whereKey($requesterId)
                ->lockForUpdate()
                ->firstOrFail();

            if ((float) $wallet->wallet_balance <= 0) {
                throw new DomainException(
                    'No funds available.'
                );
            }

            $pending = PayoutRequest::query()
                ->where('requester_type', $requesterType)
                ->where('requester_id', $requesterId)
                ->where('status', 'pending')
                ->exists();

            if ($pending) {
                throw new DomainException(
                    'You already have a pending payout request.'
                );
            }

            return PayoutRequest::create([
                'requester_type' => $requesterType,
                'requester_id' => $requesterId,
                'amount' => $wallet->wallet_balance,
                'status' => 'pending',
            ]);
        }, 3);
    }
}
