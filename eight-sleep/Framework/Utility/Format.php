<?php

declare(strict_types=1);

namespace EightSleep\Framework\Utility;

use EightSleep\Framework\Utility\Exception\FormatException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Throwable;

/**
 * Class Format
 *
 */
class Format
{
    public static function phoneNumber(string $phoneNumber, string $region = 'US'): string
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            return $phoneUtil->format($phoneUtil->parse($phoneNumber, $region), PhoneNumberFormat::E164);
        }
        catch (Throwable $e) {
            throw new FormatException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
