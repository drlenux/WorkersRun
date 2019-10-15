<?php

namespace DrLenux\WorkersRun\lock;

use DrLenux\WorkersRun\ILock;
use Symfony\Component\Lock\Store\PdoStore;
use Symfony\Component\Lock\StoreInterface;

/**
 * Class PdoLock
 * @package DrLenux\WorkersRun\lock
 */
class PdoLock implements ILock
{

    /**
     * @param string $type
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     * @return StoreInterface
     */
    public static function getStore(
        string $type = 'mysql',
        string $host = '127.0.0.1',
        string $dbname = 'lock',
        string $user = 'user',
        string $password = 'password'
    ): StoreInterface
    {
        $dsn = "{$type}:host={$host};dbname={$dbname}";
        $store = new PdoStore($dsn, ['db_username' => $user, 'db_password' => $password]);
        $store->createTable();
        return $store;
    }
}
