<?php

return [
    'clientId' => env('DINGER_CLIENT_ID'),
    'merchantKey' => env('DINGER_MERCHANT_KEY'),
    'publicKey' => env('DINGER_PUBLIC_KEY'),
    'projectName' => env('DINGER_PROJECT_NAME'),
    'merchantName' => env('DINGER_MERCHANT_NAME'),
    'hashKey' => env('DINGER_HASH_KEY'),
    'baseUrl' => env('DINGER_BASE_URL', 'https://prebuilt.dinger.asia'),
];
