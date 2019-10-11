<?php

namespace DrLenux\WorkersRun;

use AlecRabbit\Spinner\SnakeSpinner;
use Ko\ProcessManager;

/**
 * Class WorksRun
 * @package src
 */
class WorksRun
{
    /**
     * @var SnakeSpinner
     */
    private $spinner;

    /**
     * @var ProcessManager
     */
    private $manager;

    /**
     * Test constructor.
     */
    public function __construct()
    {
        $this->spinner = new SnakeSpinner();
        $this->manager = new ProcessManager();
    }

    /**
     * @param Works $works
     * @return $this
     */
    public function run(Works $works): self
    {
        foreach ($works->getWorks() as $class) {
            $this->manager->fork(function () use ($class) {
                $class->run();
            });
        }

        return $this;
    }

    public function wait(): void
    {
        $this->spinner->begin();
        while ($this->manager->count()) {
            $this->manager->dispatch();
            $this->spinner->spin();
        }
        $this->spinner->end();

        echo "\r\n";
    }
}