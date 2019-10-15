<?php

namespace DrLenux\WorkersRun\lock;

use DrLenux\WorkersRun\ILock;
use Symfony\Component\Lock\Store\RedisStore;
use Symfony\Component\Lock\StoreInterface;

/**
 * Class RedisLock
 * @package DrLenux\WorkersRun\lock
 */
class RedisLock implements ILock
{
    /**
     * @param string $host
     * @param int $port
     * @return StoreInterface
     */
    public static function getStore(string $host = '127.0.0.1', int $port = 6379): StoreInterface
    {
        $redis = new \Redis();
        $redis->connect($host, $port);

        return new RedisStore($redis);
    }
}
