<?php

namespace DrLenux\WorkersRun;

use DrLenux\WorkersRun\messenger\DB;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Lock;

/**
 * Class Messenger
 * @package DrLenux\WorkersRun
 */
class Messenger
{
    /**
     * @var Lock
     */
    private $lock;

    /**
     * @var array
     */
    private $config;

    /**
     * Messenger constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        if (isset($config['lockStore'])) {
            $store = new $config['lockStore'];
            $factory = new Factory($store);
            $this->lock = $factory->createLock(__CLASS__);
        }
    }

    /**
     * @param MessengerResponse $messengerResponse
     * @throws \Exception
     */
    public function send(MessengerResponse $messengerResponse): void
    {
        $this->wait();
        $this->getDB()->write(
            $messengerResponse->getTo(),
            $messengerResponse->getFrom(),
            $messengerResponse->getMessage()
        );
        $this->unlock();
    }

    /**
     * @param string $to
     * @param string|null $from
     * @param bool $delete
     * @return array
     * @throws \Exception
     */
    public function read(string $to, ?string $from = null, bool $delete = true): array
    {
        $this->wait();
        $res =$this->getDB()->read($to, $from, $delete);
        $this->unlock();
        return $res;
    }

    /**
     *
     */
    private function wait(): void
    {
        if ($this->lock === null) return;

        while (true) {
            if ($this->lock->acquire()) {
                usleep(200000);
                if ($this->lock->isAcquired()) {
                    break;
                }
            }
            usleep(100000);
        }
    }

    /**
     *
     */
    private function unlock()
    {
        if ($this->lock === null) return;
        sleep(0.1);
        $this->lock->release();
    }

    /**
     * @return DB
     * @throws \Exception
     */
    private function getDB(): DB
    {
        $class = $this->config['db']['class'] ?? null;

        if (null !== $class) {
            $class = new $class();
            if ($class instanceof DB) {
                return $class->init($this->config['db']['config'] ?? []);
            }
        }
        throw new \Exception("bad db");
    }
}
