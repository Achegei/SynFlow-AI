<?php

namespace Tests\Unit;

use App\Models\Payment;
use App\Services\IntaSendInvoiceVerifier;
use PHPUnit\Framework\TestCase;

class IntaSendInvoiceVerifierTest extends TestCase
{
    private function payment(): Payment
    {
        $payment = new Payment();

        $payment->payment_id = 'INV-123';
        $payment->api_ref = 'ORDER-123';
        $payment->amount = '5500.00';
        $payment->currency = 'KES';

        return $payment;
    }

    private function invoice(): object
    {
        return (object) [
            'invoice_id' => 'INV-123',
            'api_ref' => 'ORDER-123',
            'value' => '5500.00',
            'currency' => 'KES',
        ];
    }

    public function test_valid_invoice_is_accepted(): void
    {
        $this->assertTrue(
            (new IntaSendInvoiceVerifier())->verify(
                $this->payment(),
                $this->invoice()
            )
        );
    }

    public function test_incorrect_amount_is_rejected(): void
    {
        $invoice = $this->invoice();
        $invoice->value = '5000.00';

        $this->assertFalse(
            (new IntaSendInvoiceVerifier())->verify(
                $this->payment(),
                $invoice
            )
        );
    }

    public function test_incorrect_invoice_id_is_rejected(): void
    {
        $invoice = $this->invoice();
        $invoice->invoice_id = 'INV-WRONG';

        $this->assertFalse(
            (new IntaSendInvoiceVerifier())->verify(
                $this->payment(),
                $invoice
            )
        );
    }

    public function test_incorrect_api_reference_is_rejected(): void
    {
        $invoice = $this->invoice();
        $invoice->api_ref = 'ORDER-WRONG';

        $this->assertFalse(
            (new IntaSendInvoiceVerifier())->verify(
                $this->payment(),
                $invoice
            )
        );
    }

    public function test_missing_verification_fields_are_rejected(): void
    {
        $invoice = (object) [
            'state' => 'COMPLETE',
        ];

        $this->assertFalse(
            (new IntaSendInvoiceVerifier())->verify(
                $this->payment(),
                $invoice
            )
        );
    }
}
