<?php

namespace DrLenux\WorkersRun\messenger\file;

use DrLenux\WorkersRun\messenger\DB;
use DrLenux\WorkersRun\messenger\helper\ArrayHelper;
use DrLenux\WorkersRun\MessengerResponse;

/**
 * Class Yaml
 * @package src\messenger\file
 */
class Yaml implements DB
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     * @return DB
     */
    public function init(array $config): DB
    {
        $this->config = $config;
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
        $path = $this->config['file'] ?? '';
        if (!file_exists($path)) {
            throw new \Exception('not found file');
        }
        $data = yaml_parse_file($path);
        if (!is_array($data)) {
            $data = [];
        }
        $data[$to][] = ['to' => $to, 'from' => $from, 'message' => $message];
        yaml_emit_file($path, $data);
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
        $path = $this->config['file'] ?? '';
        if (!file_exists($path)) {
            throw new \Exception('not found file');
        }
        $data = yaml_parse_file($path);
        if (!is_array($data)) {
            return [];
        }

        $res = $data[$to] ?? [];

        if (null !== $from) {
            foreach ($res as $id => $item) {
                if ($item['from'] !== $from) {
                    unset($res[$id]);
                }
            }
        }

        if ($delete) {
            $data[$to] = ArrayHelper::diff($data[$to] ?? [], $res);
            yaml_emit_file($path, $data);
        }

        return array_map(function (array $item) {
            return new MessengerResponse($item['to'], $item['from'], $item['message']);
        }, $res);
    }

    /**
     * @param string $path
     */
    public function createFile(string $path): void
    {
        yaml_emit_file($path, []);
    }
}
