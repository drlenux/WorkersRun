<?php

namespace DrLenux\WorkersRun;

/**
 * Interface IWork
 * @package src
 */
interface IWork
{
    public function run(): bool;
}
