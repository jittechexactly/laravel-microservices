<?php

return [
    'timeout' => env('GATEWAY_TIMEOUT', 10),
    'retries' => env('GATEWAY_RETRIES', 1),

    'services' => [
        'identity'  => env('IDENTITY_SERVICE_URL'),
        'catalog'   => env('CATALOG_SERVICE_URL'),
        'channels'  => env('CHANNEL_SERVICE_URL'),
        'inventory' => env('INVENTORY_SERVICE_URL'),
        'orders'    => env('ORDER_SERVICE_URL'),
    ],
];
