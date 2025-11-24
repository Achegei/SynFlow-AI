<?php

// --- CONFIG ---
// Use your actual webhook URL
$url = "https://d1afed87d37e.ngrok-free.app/api/webhook/intasend";


// This must match a real payment.api_ref in your DB
$apiRef = "order-user28-course1-1763927547";

// Simulated IntaSend webhook payload EXACTLY matching real format
$data = [
    "id"        => "SIMULATED_PAYMENT_001",
    "api_ref"   => $apiRef,
    "status"    => "completed",   // Laravel expects this
    "paid"      => true,
    "amount"    => 10,
    "currency"  => "KES",
    "provider"  => "M-PESA",

    // Optional but useful for debugging
    "meta" => [
        "simulated" => true,
    ]
];

$json = json_encode($data, JSON_PRETTY_PRINT);

echo "➡️ Sending webhook for api_ref: {$apiRef}\n";

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

if ($result === FALSE) {
    echo "❌ Webhook POST failed.\n";
    if (isset($http_response_header)) {
        print_r($http_response_header);
    }
} else {
    echo "✅ Webhook delivered successfully:\n{$result}\n";
}
