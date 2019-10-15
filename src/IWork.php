<?php

namespace DrLenux\WorkersRun;

/**
 * Interface IWork
 * @package src
 */
interface IWork
{
    /**
     * @param Messenger $messenger
     * @return MessengerResponse|null
     */
    public function run(Messenger $messenger): ?MessengerResponse;
}
