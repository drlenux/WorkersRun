<?php

namespace DrLenux\WorkersRun\messenger;

use DrLenux\WorkersRun\IConfig;
use DrLenux\WorkersRun\MessengerResponse;

/**
 * Interface DB
 * @package src\messenger
 */
interface DB
{
    /**
     * @param IConfig $config
     * @return DB
     */
    public function init(IConfig $config): DB;

    /**
     * @param string $to
     * @param string $from
     * @param string $message
     */
    public function write(string $to, string $from, string $message): void;

    /**
     * @param string $to
     * @param string|null $from
     * @param bool $delete
     * @return MessengerResponse[]
     */
    public function read(string $to, ?string $from = null, bool $delete = true): array;
}
