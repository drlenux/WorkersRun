<?php

namespace DrLenux\WorkersRun\lock;

use DrLenux\WorkersRun\ILock;
use Symfony\Component\Lock\Store\FlockStore;
use Symfony\Component\Lock\StoreInterface;

/**
 * Class FileLock
 * @package DrLenux\WorkersRun\lock
 */
class FileLock implements ILock
{
    /**
     * @param string|null $dir
     * @return StoreInterface
     */
    public static function getStore(?string $dir = null): StoreInterface
    {
        return new FlockStore(($dir === null) ? sys_get_temp_dir() : $dir);
    }
}
