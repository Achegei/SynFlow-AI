<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\CommissionTransaction;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    public function process(Payment $payment): void
    {
        $alreadyProcessed = CommissionTransaction::where('payment_id', $payment->id)->exists();

        if ($alreadyProcessed) {
            return;
        }

        DB::transaction(function () use ($payment) {

            $student = $payment->user;

            if (!$student || !$student->institution) {
                return;
            }

            $institution = $student->institution;
            $salesExecutive = $institution->salesExecutive;

            if (!$salesExecutive) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | FIX: Correct amount source
            |--------------------------------------------------------------------------
            | IntaSend stores real value in payload->value or net_amount
            */

            $payload = json_decode($payment->payload, true);

            $amount =
                (float) ($payload['value']
                ?? $payload['net_amount']
                ?? $payment->amount
                ?? 0);

            if ($amount <= 0) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Commission rules
            |--------------------------------------------------------------------------
            | Institution = 40%
            | Sales Exec = 10%
            | Company = 50%
            */

            $institutionPercentage = config('commission.institution_percentage', 40);
            $salesPercentage = config('commission.sales_percentage', 10);

            $institutionAmount = ($amount * $institutionPercentage) / 100;
            $salesAmount = ($amount * $salesPercentage) / 100;
            $companyAmount = $amount - $institutionAmount - $salesAmount;

            /*
            |--------------------------------------------------------------------------
            | Update wallets
            |--------------------------------------------------------------------------
            */

            $institution->increment('wallet_balance', $institutionAmount);
            $salesExecutive->increment('wallet_balance', $salesAmount);

            /*
            |--------------------------------------------------------------------------
            | Ledger record
            |--------------------------------------------------------------------------
            */

            CommissionTransaction::create([
                'payment_id' => $payment->id,
                'student_id' => $student->id,
                'institution_id' => $institution->id,
                'sales_executive_id' => $salesExecutive->id,
                'course_id' => $payment->course_id,
                'total_amount' => $amount,
                'institution_amount' => $institutionAmount,
                'sales_amount' => $salesAmount,
                'company_amount' => $companyAmount,
            ]);
        });
    }
}