<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\CommissionTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Institution;
use App\Models\SalesExecutive;

class CommissionService
{
    public function process(Payment $payment): void
    {

            $alreadyProcessed = CommissionTransaction::where(
            'payment_id',
            $payment->id
        )->exists();

        if ($alreadyProcessed) {
            return;
        }
        DB::transaction(function () use ($payment) {

            $student = $payment->user;

            if (!$student) {
                return;
            }

            $institution = $student->institution;

            if (!$institution) {
                return;
            }

            $salesExecutive = $institution->salesExecutive;

            if (!$salesExecutive) {
                return;
            }

            $amount = $payment->amount;

            $institutionPercentage =
                config('commission.institution_percentage', 40);

            $salesPercentage =
                config('commission.sales_percentage', 10);

            $institutionAmount =
                ($amount * $institutionPercentage) / 100;

            $salesAmount =
                ($amount * $salesPercentage) / 100;

            $companyAmount =
                $amount -
                $institutionAmount -
                $salesAmount;

            /*
            |--------------------------------------------------------------------------
            | Update wallets
            |--------------------------------------------------------------------------
            */

            $institution->increment(
                'wallet_balance',
                $institutionAmount
            );

            $salesExecutive->increment(
                'wallet_balance',
                $salesAmount
            );

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