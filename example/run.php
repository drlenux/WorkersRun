<?php

require __DIR__ . '/../vendor/autoload.php';

use DrLenux\WorkersRun\Works;
use example\{Work, WorkMessageEcho};
use DrLenux\WorkersRun\WorksRun;

$works = (new Works())
    ->add(new WorkMessageEcho())
    ->add(new Work(1, 'is '))
    ->add(new Work(0, 'Hi, '))
    ->add(new Work(0.7, 'what '))
    ->add(new Work(2, 'name?'))
    ->add(new Work(1.5, 'your '));

$config = require __DIR__ . '/config.php';

(new WorksRun($config))
    ->run($works)
    ->wait();

