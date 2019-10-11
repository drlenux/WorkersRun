<?php

namespace DrLenux\WorkersRun;

/**
 * Class Works
 * @package src
 */
class Works
{
    /**
     * @var IWork[]
     */
    private $works = [];

    /**
     * @param IWork $class
     * @return $this
     */
    public function add(IWork $class): self
    {
        $this->works[] = $class;
        return $this;
    }

    /**
     * @return IWork[]
     */
    public function getWorks(): array
    {
        return $this->works;
    }
}
