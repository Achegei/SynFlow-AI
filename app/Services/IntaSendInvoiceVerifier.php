<?php

namespace App\Services;

use App\Models\Payment;

class IntaSendInvoiceVerifier
{
    public function verify(Payment $payment, object $invoice): bool
    {
        $invoiceId = $invoice->invoice_id ?? null;
        $apiRef = $invoice->api_ref ?? null;
        $amount = $invoice->value ?? null;
        $currency = $invoice->currency ?? null;

        if (
            $invoiceId === null ||
            $apiRef === null ||
            $amount === null ||
            $currency === null
        ) {
            return false;
        }

        if (!hash_equals(
            (string) $payment->payment_id,
            (string) $invoiceId
        )) {
            return false;
        }

        if (!hash_equals(
            (string) $payment->api_ref,
            (string) $apiRef
        )) {
            return false;
        }

        if (strtoupper(trim((string) $currency)) !==
            strtoupper(trim((string) $payment->currency))) {
            return false;
        }

        if (!is_numeric($amount)) {
            return false;
        }

        return (int) round(((float) $amount) * 100) ===
            (int) round(((float) $payment->amount) * 100);
    }
}
