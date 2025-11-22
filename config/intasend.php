<?php

return [
    'publishable_key' => env('INTASEND_PUBLISHABLE_KEY'),
    'secret_key'      => env('INTASEND_SECRET_KEY'),
    'webhook_secret'  => env('INTASEND_WEBHOOK_SECRET'),
    'test'            => env('INTASEND_TEST_ENVIRONMENT', true),
];
