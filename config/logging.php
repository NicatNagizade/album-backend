<?php

return [
    'channels' => [
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/daily/d.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 10
        ]
    ]
];
