<?php

use DrLenux\WorkersRun\messenger\SemaphoreDb;
use DrLenux\WorkersRun\messenger\config\SemaphoreDbConfig;
use DrLenux\WorkersRun\lock\SemaphoreLock;

return [
    'messenger' => [
        'lockStore' => SemaphoreLock::getStore(),
        'db' => [
            'class' => SemaphoreDb::class,
            'config' => new SemaphoreDbConfig(123, 500),
        ]
    ]
];
