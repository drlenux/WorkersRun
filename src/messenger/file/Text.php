<?php


namespace DrLenux\WorkersRun\messenger\file;


use DrLenux\WorkersRun\messenger\DB;
use DrLenux\WorkersRun\MessengerResponse;

class Text implements DB
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
            throw new \Exception("not found file: [{$path}]");
        }
        $f = fopen($path, 'a+');
        $line = "{$to}\t{$from}\t{$message}\r\n";
        fwrite($f, $line);
        fclose($f);
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
            throw new \Exception("not found file: [{$path}]");
        }

        $file = file($path);
        if (!is_array($file)) {
            throw new \Exception('not found file');
        }

        $res = [];
        $delId = [];

        foreach ($file as $id => $item) {
            $line = explode("\t", $item);
            if ($line[0] === $to) {
                if (null !== $from && $line[1] !== $from) {
                    continue;
                }
                $res[] = $line;
                if ($delete) {
                    $delId[] = $id;
                }
            }
        }

        if ($delete) {
            foreach ($delId as $id) {
                unset($file[$id]);
            }
            file_put_contents($path, implode("\r\n", $file));
        }

        return array_map(function (array $item) {
            return new MessengerResponse(...$item);
        }, $res);
    }

    /**
     * @param string $path
     */
    public function createFile(string $path): void
    {
        file_put_contents($path, '');
    }
}