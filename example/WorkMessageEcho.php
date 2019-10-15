<?php

namespace example;

use DrLenux\WorkersRun\Messenger;
use DrLenux\WorkersRun\IWork;
use DrLenux\WorkersRun\MessengerResponse;

/**
 * Class WorkMessageEcho
 * @package example
 */
class WorkMessageEcho implements IWork
{
    /**
     * @param Messenger $messenger
     * @return MessengerResponse|null
     * @throws \Exception
     */
    public function run(Messenger $messenger): ?MessengerResponse
    {
        $count = 0;
        $maxCount = 5;
        while (true) {
            if ($count++ >= $maxCount) {
                break;
            }
            $res = $messenger->read(__CLASS__);
            if (count($res)) {
                foreach ($res as $item) {
                    /** @var MessengerResponse $item */
                    echo $item->getMessage();
                }
                $count = 0;
            }
            usleep(250000);
        }

        return null;
    }
}