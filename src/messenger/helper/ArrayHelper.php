<?php

namespace DrLenux\WorkersRun\messenger\helper;

/**
 * Class ArrayHelper
 * @package src\messenger\helper
 */
class ArrayHelper
{
    /**
     * @param array $a
     * @param array $b
     * @return array
     */
    public static function diff(array $a, array $b): array
    {
        foreach ($a as &$item) {
            $item = json_encode($item);
        }

        foreach ($b as &$item) {
            $item = json_encode($item);
        }

        $diff = array_diff($a, $b);
        foreach ($diff as &$item) {
            $item = json_decode($item, true);
        }

        return $diff;
    }
}
