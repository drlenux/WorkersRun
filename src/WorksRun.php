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
     * @var IMessenger
     */
    private $messenger;

    /**
     * WorksRun constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->spinner = new SnakeSpinner();
        $this->manager = new ProcessManager();
        $this->messenger = new Messenger($config['messenger']);
    }

    /**
     * @param Works $works
     * @return $this
     */
    public function run(Works $works): self
    {
        $messenger = $this->messenger;
        foreach ($works->getWorks() as $class) {
            $this->manager->fork(function () use ($class, $messenger) {
                $message = $class->run($messenger);
                if (null !== $message) {
                    $messenger->send($message);
                }
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