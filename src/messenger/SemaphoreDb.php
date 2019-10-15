<?php

namespace DrLenux\WorkersRun\messenger;

use DrLenux\WorkersRun\IConfig;
use DrLenux\WorkersRun\messenger\config\SemaphoreDbConfig;
use DrLenux\WorkersRun\MessengerResponse;

/**
 * Class SemaphoreDb
 * @package DrLenux\WorkersRun\messenger
 */
class SemaphoreDb implements DB
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var resource
     */
    private $ip;

    /**
     * @param IConfig $config
     * @return DB
     * @throws \Exception
     */
    public function init(IConfig $config): DB
    {
        if ($config instanceof SemaphoreDbConfig) {
            $this->config = $config->getAll();
            $this->ip = msg_get_queue($this->config['name']);
            return $this;
        }
        throw new \Exception("bad config");
    }

    /**
     * @param string $to
     * @param string $from
     * @param string $message
     */
    public function write(string $to, string $from, string $message): void
    {
        msg_send($this->ip, 1, [$to, $from, $message]);
    }

    /**
     * @param string $to
     * @param string|null $from
     * @param bool $delete
     * @return MessengerResponse[]
     */
    public function read(string $to, ?string $from = null, bool $delete = true): array
    {
        msg_receive($this->ip, 0, $msgType, $this->config['size'], $data, true, MSG_IPC_NOWAIT, $err);
        if (is_array($data)) {
            return [new MessengerResponse(...$data)];
        }
        return [];
    }
}