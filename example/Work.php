<?php

namespace example;

use DrLenux\WorkersRun\Messenger;
use DrLenux\WorkersRun\IWork;
use DrLenux\WorkersRun\MessengerResponse;

/**
 * Class Work
 * @package example
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
     * @param Messenger $messenger
     * @return MessengerResponse|null
     */
    public function run(Messenger $messenger): ?MessengerResponse
    {
        usleep($this->time * self::U_SLEEP);
        return (new MessengerResponse(WorkMessageEcho::class, getmypid(), $this->message));
    }
}
