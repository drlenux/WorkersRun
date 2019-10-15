<?php

namespace DrLenux\WorkersRun;

use Symfony\Component\Lock\StoreInterface;

/**
 * Interface ILock
 * @package DrLenux\WorkersRun
 */
interface ILock
{
    /**
     * @return StoreInterface
     */
    public static function getStore(): StoreInterface;
}
