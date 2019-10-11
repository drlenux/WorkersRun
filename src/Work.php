<?php

namespace DrLenux\WorkersRun;

/**
 * Class Work
 * @package src
 */
class Work implements IWork
{
    const U_SLEEP = 1000000;
    /**
     * @var float|int
     */
    private $time = 0;

    /**
     * @var string
     */
    private $message  = '';

    /**
     * Work constructor.
     * @param float $time
     * @param string $message
     */
    public function __construct(float $time, string $message)
    {
        $this->time = $time;
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        usleep($this->time * self::U_SLEEP);
        echo $this->message;
        return true;
    }
}
