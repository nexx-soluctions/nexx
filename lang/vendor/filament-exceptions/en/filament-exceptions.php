<?php

return [

    'labels' => [
        'model' => 'Exception Logs',
        'model_plural' => 'Exceptions Logs',
        'navigation' => 'Exception Logs',
        'navigation_group' => 'Statistics',
        'tabs' => [
            'exception' => 'Exception',
            'headers' => 'Headers',
            'cookies' => 'Cookies',
            'body' => 'Body',
            'queries' => 'Queries',
        ],
    ],
    'empty_list' => 'Horray! just sit back & enjoy 😎',
    'columns' => [
        'method' => 'Method',
        'path' => 'Path',
        'type' => 'Type',
        'code' => 'Code',
        'ip' => 'IP',
        'occurred_at' => 'Occurred at',
    ],
];
