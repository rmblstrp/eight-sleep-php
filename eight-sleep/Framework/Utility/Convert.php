<?php

declare(strict_types=1);

namespace EightSleep\Framework\Utility;

use Carbon\Carbon;
use DateTime;
use EightSleep\Framework\Utility\Exception\ConvertException;
use Exception;
use Iterator;
use IteratorAggregate;

/**
 * Class Convert
 */
abstract class Convert
{
    /**
     * @param mixed $value
     * @return mixed
     * @throws ConvertException
     */
    private static function ensureIsPrimitiveType($value)
    {
        if (is_object($value) && method_exists($value, '__toString')) {
            return (string)$value;
        }
        else {
            if (is_object($value) || is_array($value)) {
                throw new ConvertException('Only primitive data types are supported.');
            }
        }

        return $value;
    }

    /**
     * @param mixed $value
     * @param bool $returnNull
     * @return array
     */
    public static function toArray($value, bool $returnNull = false)
    {
        if (is_array($value)) return $value;

        if ($value === null) return $returnNull ? null : [];

        if (is_object($value)) {
            if ($value instanceof IteratorAggregate) {
                return (array)$value->getIterator();
            }

            if ($value instanceof Iterator) {
                return (array)$value;
            }

            if (method_exists($value, 'toArray')) {
                return $value->toArray();
            }
        }

        return [$value];
    }

    /**
     * @param string|int|float|bool|null $value
     * @param bool $nullToFalse
     * @return bool|null
     * @throws ConvertException
     */
    public static function toBoolean($value, bool $nullToFalse = false)
    {
        $value = self::ensureIsPrimitiveType($value);

        if (is_null($value) || (is_string($value) && strlen($value) == 0)) {
            return $nullToFalse ? false : null;
        }

        if (is_string($value)) {
            $value = trim(strtolower($value));

            if ($value === 'false') {
                return false;
            }

            if ($value !== 'true' && !is_numeric($value)) {
                throw new ConvertException(sprintf('Unable to convert value (%s) to a boolean', var_export($value, true)));
            }
        }

        return boolval($value);
    }

    /**
     * @param int|float|string|DateTime|null $value
     * @return Carbon|null
     * @throws ConvertException
     */
    public static function toCarbon($value)
    {
        if ($value instanceof Carbon) return $value;
        if ($value instanceof DateTime) return Carbon::instance($value);

        $value = self::ensureIsPrimitiveType($value);

        if (is_null($value) || (is_string($value) && strlen($value) == 0)) {
            return null;
        }

        if (is_numeric($value)) {
            return Carbon::createFromTimestampUTC(self::toInteger($value));
        }

        try {
            if (is_string($value)) {
                return new Carbon($value);
            }
        }
        catch (Exception $e) {
        }

        throw new ConvertException(sprintf('Unable to convert value (%s) to a Carbon instance', var_export($value, true)));
    }

    /**
     * @param string|int|float|bool|null $value
     * @param bool $nullToZero
     * @return float|null
     * @throws ConvertException
     */
    public static function toFloat($value, bool $nullToZero = false)
    {
        $value = self::ensureIsPrimitiveType($value);

        if (is_numeric($value)) {
            return floatval($value);
        }

        if (is_null($value) || (is_string($value) && strlen($value) == 0)) {
            return $nullToZero ? 0 : null;
        }

        if (is_string($value)) {
            $modifiedValue = preg_replace('/([^0-9\\.])/i', '', $value);

            if (strlen($modifiedValue) > 0) {
                return floatval($modifiedValue);
            }
        }

        throw new ConvertException(sprintf('Unable to convert value (%s) to a float', var_export($value, true)));
    }

    /**
     * @param string|int|float|bool|null $value
     * @param bool $nullToZero
     * @return int|null
     * @throws ConvertException
     */
    public static function toInteger($value, bool $nullToZero = false)
    {
        $value = self::ensureIsPrimitiveType($value);

        if (is_numeric($value)) {
            return intval($value);
        }

        if (is_null($value) || (is_string($value) && strlen($value) == 0)) {
            return $nullToZero ? 0 : null;
        }

        if (is_string($value)) {
            $modifiedValue = preg_replace('/([^0-9\\.])/i', '', $value);

            if (strlen($modifiedValue) > 0) {
                return intval($modifiedValue);
            }
        }

        if (is_bool($value)) {
            return intval($value);
        }

        throw new ConvertException(sprintf('Unable to convert value (%s) to an integer', var_export($value, true)));
    }

    /**
     * @param string|int|float|bool|object|null $value
     * @param bool $nullToString
     * @return null|string
     * @throws ConvertException
     */
    public static function toString($value, bool $nullToString = false)
    {
        $value = self::ensureIsPrimitiveType($value);

        if (is_null($value)) {
            return $nullToString ? '' : null;
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return (string)$value;
    }
}
