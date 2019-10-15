<?php

namespace DrLenux\WorkersRun\messenger;

use DrLenux\WorkersRun\MessengerResponse;

/**
 * Interface DB
 * @package src\messenger
 */
interface DB
{
    /**
     * @param array $config
     * @return $this
     */
    public function init(array $config): DB;

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

    /**
     * @param string $path
     */
    public function createFile(string $path): void;
}
