<?php

namespace DrLenux\WorkersRun\messenger\file;

/**
 * Interface IFile
 * @package DrLenux\WorkersRun\messenger\file
 */
interface IFile
{
    /**
     * @param string $path
     */
    public function createFile(string $path): void;
}
