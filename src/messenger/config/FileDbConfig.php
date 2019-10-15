<?php

namespace DrLenux\WorkersRun\messenger\config;

use DrLenux\WorkersRun\IConfig;
use DrLenux\WorkersRun\messenger\FileDb;

/**
 * Class FileDbConfig
 * @package DrLenux\WorkersRun\messenger\config
 */
class FileDbConfig implements IConfig
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $file;

    /**
     * FileDbConfig constructor.
     * @param string $type
     * @param string $file
     */
    public function __construct(string $file, string $type = FileDb::FILE_TYPE_TEXT)
    {
        $this->type = $type;
        $this->file = $file;
    }


    /**
     * @return array
     */
    public function getAll(): array
    {
        return [
            'type' => $this->type,
            'file' => $this->file
        ];
    }
}