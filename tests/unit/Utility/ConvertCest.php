<?php

declare(strict_types=1);

namespace Tests\Unit\Utility;

use Carbon\Carbon;
use EightSleep\Framework\Utility\Convert;
use EightSleep\Framework\Utility\Exception\ConvertException;
use UnitTester;

/**
 * Class ConvertCest
 */
class ConvertCest
{
    /**
     * @param UnitTester $I
     */
    public function convertValueToArray(UnitTester $I)
    {
        $I->assertSame([1], Convert::toArray([1]));
        $I->assertSame([1], Convert::toArray(1));
        $I->assertSame([], Convert::toArray(null));
        $I->assertSame(null, Convert::toArray(null, true));

        $instance = new ConvertObject(0);
        $I->assertSame([1, 2, 3], Convert::toArray($instance));
        $I->assertSame([1, 2, 3], Convert::toArray($instance->getIterator()));

        $instance = new ArrayObject();
        $I->assertSame(['just' => 'Expanding', 'possibilities' => '!!!'], Convert::toArray($instance));
    }

    /**
     * @param UnitTester $I
     */
    public function convertValueToBoolean(UnitTester $I)
    {
        $I->assertSame(true, Convert::toBoolean(true));
        $I->assertSame(true, Convert::toBoolean('true'));
        $I->assertSame(true, Convert::toBoolean(-1));
        $I->assertSame(true, Convert::toBoolean(1));
        $I->assertSame(true, Convert::toBoolean(2));
        $I->assertSame(true, Convert::toBoolean('-1'));
        $I->assertSame(true, Convert::toBoolean('1'));
        $I->assertSame(true, Convert::toBoolean('2'));

        $I->assertSame(false, Convert::toBoolean(false));
        $I->assertSame(false, Convert::toBoolean('false'));
        $I->assertNull(Convert::toBoolean(null));
        $I->assertSame(false, Convert::toBoolean(null, true));
        $I->assertSame(false, Convert::toBoolean(0));
        $I->assertSame(false, Convert::toBoolean('0'));

        $instance = new ConvertObject(0);
        $I->assertSame(false, Convert::toBoolean($instance));

        $I->expectThrowable(ConvertException::class, function () {
            Convert::toBoolean('throw exception');
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toBoolean(new \stdClass());
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toBoolean([1, 2, 3]);
        });
    }

    /**
     * @param UnitTester $I
     */
    public function convertValueToCarbon(UnitTester $I)
    {
        $converted = Convert::toCarbon(1);
        $I->assertInstanceOf(Carbon::class, $converted);
        $I->assertSame(1, $converted->timestamp);

        $carbon = Carbon::now();
        $converted = Convert::toCarbon(Carbon::now()->format('c'));
        $I->assertInstanceOf(Carbon::class, $converted);
        $I->assertSame($carbon->timestamp, $converted->timestamp);

        $I->assertNull(Convert::toCarbon(null));
        $I->assertNull(Convert::toCarbon(''));

        $instance = new ConvertObject($carbon->format('c'));
        $converted = Convert::toCarbon($instance);
        $I->assertSame($carbon->timestamp, $converted->timestamp);

        $I->expectThrowable(ConvertException::class, function () {
            Convert::toCarbon('throw exception');
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toCarbon(new \stdClass());
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toCarbon([1, 2, 3]);
        });
    }

    /**
     * @param UnitTester $I
     */
    public function convertValueToFloat(UnitTester $I)
    {
        $I->assertSame(1.0, Convert::toFloat(1));
        $I->assertSame(1.0, Convert::toFloat('1'));
        $I->assertSame(1.0, Convert::toFloat('$1'));
        $I->assertSame(1.234, Convert::toFloat(1.234));
        $I->assertSame(1.234, Convert::toFloat('1.234'));
        $I->assertSame(1.234, Convert::toFloat('$1.234'));
        $I->assertSame(0, Convert::toFloat(null, true));
        $I->assertNull(Convert::toFloat(null));

        $instance = new ConvertObject(1.234);
        $I->assertSame(1.234, Convert::toFloat($instance));

        $I->expectThrowable(ConvertException::class, function () {
            Convert::toFloat('throw exception');
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toFloat(new \stdClass());
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toFloat([1, 2, 3]);
        });
    }

    /**
     * @param UnitTester $I
     */
    public function convertValueToInteger(UnitTester $I)
    {
        $I->assertSame(1, Convert::toInteger(1));
        $I->assertSame(1, Convert::toInteger('1'));
        $I->assertSame(1, Convert::toInteger('$1'));
        $I->assertSame(1, Convert::toInteger(1.234));
        $I->assertSame(1, Convert::toInteger('1.234'));
        $I->assertSame(1, Convert::toInteger('$1.234'));
        $I->assertSame(1, Convert::toInteger(true));
        $I->assertSame(0, Convert::toInteger(false));
        $I->assertSame(0, Convert::toInteger(null, true));
        $I->assertNull(Convert::toInteger(null));

        $instance = new ConvertObject(1.234);
        $I->assertSame(1, Convert::toInteger($instance));

        $I->expectThrowable(ConvertException::class, function () {
            Convert::toInteger('throw exception');
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toInteger(new \stdClass());
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toInteger([1, 2, 3]);
        });
    }

    /**
     * @param UnitTester $I
     */
    public function convertValueToString(UnitTester $I)
    {
        $I->assertSame('1', Convert::toString(1));
        $I->assertSame('1', Convert::toString('1'));
        $I->assertSame('1.234', Convert::toString(1.234));
        $I->assertNull(Convert::toString(null));
        $I->assertSame('', Convert::toString(null, true));
        $I->assertSame('true', Convert::toString(true));
        $I->assertSame('false', Convert::toString(false));

        $instance = new ConvertObject(1.234);
        $I->assertSame('1.234', Convert::toString($instance));

        $I->expectThrowable(ConvertException::class, function () {
            Convert::toInteger(new \stdClass());
        });
        $I->expectThrowable(ConvertException::class, function () {
            Convert::toInteger([1, 2, 3]);
        });
    }
}
