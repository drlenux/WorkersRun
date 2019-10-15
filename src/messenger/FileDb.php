<?php

namespace DrLenux\WorkersRun\messenger;

use DrLenux\WorkersRun\messenger\file\Json;
use DrLenux\WorkersRun\messenger\file\Text;
use DrLenux\WorkersRun\messenger\file\Yaml;

/**
 * Class FileDb
 * @package src\messenger
 */
class FileDb implements DB
{
    const FILE_TYPE_TEXT = 'text';
    const FILE_TYPE_YAML = 'yaml';
    const FILE_TYPE_JSON = 'json';

    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     * @return DB
     * @throws \Exception
     */
    public function init(array $config): DB
    {
        $path = $config['file'];
        $this->config = $config;
        if (!file_exists($path)) {
            $this->createFile($path);
        }
        return $this;
    }

    /**
     * @param string $to
     * @param string $from
     * @param string $message
     * @throws \Exception
     */
    public function write(string $to, string $from, string $message): void
    {
        $class = $this->getClass();
        if (null !== $class) {
            $class->write($to, $from, $message);
        }
    }

    /**
     * @param string $to
     * @param string|null $from
     * @param bool $delete
     * @return array
     * @throws \Exception
     */
    public function read(string $to, ?string $from = null, bool $delete = true): array
    {
        return $this->getClass()->read($to, $from, $delete);
    }

    /**
     * @return DB
     * @throws \Exception
     */
    private function getClass(): DB
    {
        $class = null;
        switch ($this->config['type'] ?? self::FILE_TYPE_TEXT) {
            case self::FILE_TYPE_TEXT :
                $class = (new Text());
                break;
            case self::FILE_TYPE_JSON :
                $class = (new Json());
                break;
            case self::FILE_TYPE_YAML :
                $class = (new Yaml());
                break;
            default :
                throw new \Exception("bad file type");
        }

        return $class->init($this->config);
    }

    /**
     * @param string $path
     * @throws \Exception
     */
    public function createFile(string $path): void
    {
        $this->getClass()->createFile($path);
    }
}
