<?php

use Symfony\Component\Lock\Store\FlockStore;
use DrLenux\WorkersRun\messenger\FileDb;

return [
    'messenger' => [
        'lockStore' => FlockStore::class,
        'db' => [
            'class' => FileDb::class,
            'config' => [
                'type' => FileDb::FILE_TYPE_YAML,
                'file' => __DIR__ . '/mess.yaml'
            ]
        ]
    ]
];
