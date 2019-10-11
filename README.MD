[![Latest Stable Version](https://img.shields.io/packagist/v/drlenux/workers-run.svg)](https://packagist.org/packages/drlenux/workers-run)
[![Total Downloads](https://img.shields.io/packagist/dt/drlenux/workers-run.svg)](https://packagist.org/packages/drlenux/workers-run)
[![php version](https://img.shields.io/packagist/php-v/drlenux/workers-run.svg)](https://packagist.org/packages/drlenux/workers-run)


EXAMPLE

```php
<?php

use DrLenux\WorkersRun\Works;
use DrLenux\WorkersRun\Work;
use DrLenux\WorkersRun\WorksRun;

$works = (new Works())
    ->add(new Work(1, 'is '))
    ->add(new Work(0, 'Hi, '))
    ->add(new Work(0.7, 'what '))
    ->add(new Work(1.5, 'your '))
    ->add(new Work(2, 'name?'));

(new WorksRun())
    ->run($works)
    ->wait();

```

![](./example/example.gif)