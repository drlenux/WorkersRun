<?php

namespace DrLenux\WorkersRun;

/**
 * Class MessengerResponse
 * @package DrLenux\WorkersRun
 */
class MessengerResponse
{
    /**
     * @var string
     */
    private $to;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $message;

    /**
     * MessangerResponse constructor.
     * @param string $to
     * @param string $from
     * @param string $message
     */
    public function __construct(string $to, string $from, string $message)
    {
        $this->to = $to;
        $this->from = $from;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
