<?php

return [
    'timeout' => env('GATEWAY_TIMEOUT', 10),
    'retries' => env('GATEWAY_RETRIES', 1),
    
    'services' => [
        'identity'  => env('IDENTITY_SERVICE_URL'),
        'notification'   => env('NOTIFICATION_SERVICE_URL'),
        'apigateway'  => env('API_GATEWAYURL'),
    ],
];
