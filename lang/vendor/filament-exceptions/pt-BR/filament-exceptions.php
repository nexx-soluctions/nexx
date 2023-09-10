<?php

return [
    'labels' => [
        'model' => 'Logs Exception',
        'model_plural' => 'Logs Exceptions',
        'navigation' => 'Logs Exception',
        'navigation_group' => 'Estatísticas',
        'tabs' => [
            'exception' => 'Exception',
            'headers' => 'Headers',
            'cookies' => 'Cookies',
            'body' => 'Body',
            'queries' => 'Queries',
        ],
    ],

    'empty_list' => 'Nenhuma Exception encontrada.',

    'columns' => [
        'method' => 'Method',
        'path' => 'Path',
        'type' => 'Type',
        'code' => 'Code',
        'ip' => 'IP',
        'occurred_at' => 'Occurred at',
    ],
];
