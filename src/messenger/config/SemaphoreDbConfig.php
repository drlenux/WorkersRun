<?php

namespace DrLenux\WorkersRun\messenger\config;

use DrLenux\WorkersRun\IConfig;

/**
 * Class SemaphoreDbConfig
 * @package DrLenux\WorkersRun\messenger\config
 */
class SemaphoreDbConfig implements IConfig
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $size;

    /**
     * SemaphoreDbConfig constructor.
     * @param string $name
     * @param int $size
     */
    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return [
            'name' => $this->name,
            'size' => $this->size
        ];
    }
}
