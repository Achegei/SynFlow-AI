<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\CommissionTransaction;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    public function process(Payment $payment): void
    {
        if ($payment->course_enrollment_id !== null) {
            $this->processEnrollmentCommission($payment);
            return;
        }

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

            $payload = $payment->payload ?? [];

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
            $institutionAmount = round(
                ($amount * $institutionPercentage) / 100,
                2
            );

            $salesAmount = (
                $payment->payment_type === 'course'
                && $payment->package_id === null
                && $amount === 5500.0
            ) ? 1000.00 : 0.00;

            $companyAmount = round(
                $amount - $institutionAmount - $salesAmount,
                2
            );

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

    private function processEnrollmentCommission(Payment $payment): void
    {
        DB::transaction(function () use ($payment) {
            $enrollment = \App\Models\CourseEnrollment::query()
                ->whereKey($payment->course_enrollment_id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                (int) $payment->user_id !== (int) $enrollment->user_id ||
                (int) $payment->course_id !== (int) $enrollment->course_id
            ) {
                throw new \DomainException(
                    'Payment does not match its enrollment.'
                );
            }

            if (
                $payment->status !== 'paid' ||
                $payment->payment_type !== 'course' ||
                $payment->package_id !== null ||
                $payment->currency !== 'KES' ||
                (float) $payment->amount !== (float) config('enrollment.fee')
            ) {
                throw new \DomainException(
                    'Payment does not qualify for enrollment commission.'
                );
            }

            if (
                CommissionTransaction::where(
                    'course_enrollment_id',
                    $enrollment->id
                )->exists()
            ) {
                return;
            }

            if ($enrollment->registration_context === 'other') {
                if (
                    $enrollment->institution_id !== null ||
                    $enrollment->sales_executive_id !== null
                ) {
                    throw new \DomainException(
                        'Independent enrollment has institutional attribution.'
                    );
                }

                return;
            }

            if ($enrollment->registration_context !== 'institution') {
                throw new \DomainException(
                    'Unknown enrollment registration context.'
                );
            }

            if (
                !$enrollment->institution_id ||
                !$enrollment->sales_executive_id
            ) {
                throw new \DomainException(
                    'Institutional enrollment attribution is incomplete.'
                );
            }

            $institution = \App\Models\Institution::query()
                ->whereKey($enrollment->institution_id)
                ->firstOrFail();

            $salesExecutive = \App\Models\SalesExecutive::query()
                ->whereKey($enrollment->sales_executive_id)
                ->firstOrFail();

            $amount = (float) config('enrollment.fee');

            $institutionAmount = round(
                $amount * (float) config('enrollment.institution_percentage') / 100,
                2
            );

            $salesAmount = (float) config('enrollment.sales_commission');

            $companyAmount = round(
                $amount - $institutionAmount - $salesAmount,
                2
            );

            CommissionTransaction::create([
                'payment_id' => $payment->id,
                'course_enrollment_id' => $enrollment->id,
                'student_id' => $enrollment->user_id,
                'institution_id' => $institution->id,
                'sales_executive_id' => $salesExecutive->id,
                'course_id' => $enrollment->course_id,
                'total_amount' => $amount,
                'institution_amount' => $institutionAmount,
                'sales_amount' => $salesAmount,
                'company_amount' => $companyAmount,
            ]);

            $institution->increment('wallet_balance', $institutionAmount);
            $salesExecutive->increment('wallet_balance', $salesAmount);
        });
    }

}