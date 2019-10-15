<?php

namespace DrLenux\WorkersRun\lock;

use DrLenux\WorkersRun\ILock;
use Symfony\Component\Lock\Store\SemaphoreStore;
use Symfony\Component\Lock\StoreInterface;

/**
 * Class SemaphoreLock
 * @package DrLenux\WorkersRun\lock
 */
class SemaphoreLock implements ILock
{
    /**
     * @return StoreInterface
     */
    public static function getStore(): StoreInterface
    {
        return new SemaphoreStore();
    }
}
