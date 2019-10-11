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