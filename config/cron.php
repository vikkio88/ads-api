<?php

return [
    'jobs' => [
        [
            'name' => 'simulateDay',
            'class_name' => 'SimulateDay',
            'args' => null,
            'delta_minutes' => 60 * 24,
            'active' => true,
            'fire_time' => null,
            'priority' => 0
        ]
    ],
    'namespaces' => [
        'App\Scripts\\'
    ]
];
