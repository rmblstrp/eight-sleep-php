<?php

declare(strict_types=1);

namespace EightSleep\Framework\Utility;

use ArrayAccess;
use EightSleep\Framework\Utility\Exception\ArrayException;

/**
 * Class Arrays
 */
abstract class Arr
{
    /**
     * Determine whether the given value is array accessible.
     *
     * @param  mixed $value
     * @return bool
     */
    public static function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    /**
     * @param array $array
     * @return bool
     */
    public static function isAssociative(array $array)
    {
        // Keys of the array
        $keys = array_keys($array);

        // If the array keys of the keys match the keys, then the array must
        // not be associative (e.g. the keys array looked like {0:0, 1:1...}).
        return array_keys($keys) !== $keys;
    }

    /**
     * @param string $property
     * @param array|ArrayAccess $items
     * @param bool $group
     * @return array
     * @throws ArrayException
     */
    public static function key(string $property, $items, bool $group = false)
    {
        if (!static::accessible($items)) {
            throw new ArrayException('$items must be an array or an object that implements the ArrayAccess interface');
        }

        $keyed = [];
        foreach ($items as $item) {
            if (is_array($item)) {
                $key = $item[$property];
            }
            else if (is_object($item)) {
                $key = $item->{$property};
            }
            else {
                throw new ArrayException('Only arrays and objects are supported');
            }

            if (is_object($key) || is_array($key)) {
                throw new ArrayException('Only primitive values may be used as keys');
            }

            if ($group) {
                $keyed[$key][] = $item;
            }
            else {
                $keyed[$key] = $item;
            }
        }

        return $keyed;
    }
}
