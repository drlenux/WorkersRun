<?php

namespace DrLenux\WorkersRun\lock;

use DrLenux\WorkersRun\ILock;
use Symfony\Component\Lock\Store\MemcachedStore;
use Symfony\Component\Lock\StoreInterface;

/**
 * Class MemcachedLock
 * @package DrLenux\WorkersRun\lock
 */
class MemcachedLock implements ILock
{
    /**
     * @param string $host
     * @param int $port
     * @return StoreInterface
     */
    public static function getStore(string $host = '127.0.0.1', int $port = 11211): StoreInterface
    {
        $memcached = new \Memcached();
        $memcached->addServer($host, $port);
        return new MemcachedStore($memcached);
    }
}
