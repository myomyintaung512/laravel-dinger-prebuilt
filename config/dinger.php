<?php

return [
    'client_id' => env('DINGER_CLIENT_ID'),
    'merchant_key' => env('DINGER_MERCHANT_KEY'),
    'public_key' => env('DINGER_PUBLIC_KEY'),
    'project_name' => env('DINGER_PROJECT_NAME'),
    'merchant_name' => env('DINGER_MERCHANT_NAME'),
    'hash_key' => env('DINGER_HASH_KEY'),
    'base_url' => env('DINGER_BASE_URL', 'https://prebuilt.dinger.asia'),
];
