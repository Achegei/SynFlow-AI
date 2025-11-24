<?php
use App\Models\Payment;

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Find the latest pending payment
$payment = Payment::where('status', 'PENDING')->latest()->first();

if (!$payment) {
    echo "❌ No pending payments found.\n";
    exit;
}

// Build webhook payload
$data = [
    "api_ref"    => $payment->payment_id ?? 'SIM_REF_DEBUG_' . $payment->id,
    "status"     => "SUCCESS",
    "state"      => "COMPLETE",
    "paid"       => true,
    "amount"     => $payment->amount,
    "currency"   => "KES",
    "invoice_id" => "DEBUG_INV_" . $payment->id,
    "provider"   => "M-PESA",
    "meta"       => [
        "course_id" => $payment->course_id,
        "user_id"   => $payment->user_id
    ]
];

$json = json_encode($data);
$url = "https://fb74147f90ed.ngrok-free.app/api/webhook/intasend";

echo "➡️ Sending webhook for payment_id {$payment->id}...\n";

$opts = [
    "http" => [
        "method"  => "POST",
        "header"  => "Content-Type: application/json\r\n",
        "content" => $json,
        "ignore_errors" => true,
    ],
    "ssl" => [
        "verify_peer"      => false,
        "verify_peer_name" => false,
    ]
];

$context = stream_context_create($opts);
$result = @file_get_contents($url, false, $context);

if ($result === false) {
    echo "❌ Webhook POST failed.\n";
    if (isset($http_response_header)) {
        print_r($http_response_header);
    }
} else {
    echo "✅ Webhook delivered successfully:\n";
    echo $result . "\n";
}
