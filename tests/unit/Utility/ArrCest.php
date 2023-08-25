<?php

declare(strict_types=1);

namespace Tests\Unit\Utility;

use EightSleep\Framework\Utility\Arr;
use EightSleep\Framework\Utility\Exception\ArrayException;
use UnitTester;

/**
 * Class ArrCest
 */
class ArrCest
{
    /**
     * @param UnitTester $I
     */
    public function arrayIsAssociative(UnitTester $I)
    {
        $linear = [1, 2, 3];
        $associative = [
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ];

        $I->assertFalse(Arr::isAssociative($linear));
        $I->assertTrue(Arr::isAssociative($associative));
    }

    public function generateKeyedArrayFromArray(UnitTester $I)
    {
        $sourceArray = [
            ['id' => 'id-1'],
            ['id' => 'id-2'],
            ['id' => 'id-3'],
        ];

        $keyedArray = Arr::key('id', $sourceArray);
        $I->assertSame($sourceArray[0]['id'], $keyedArray['id-1']['id']);
        $I->assertSame($sourceArray[1]['id'], $keyedArray['id-2']['id']);
        $I->assertSame($sourceArray[2]['id'], $keyedArray['id-3']['id']);
    }

    /**
     * @param UnitTester $I
     * @throws ArrayException
     */
    public function generateKeyedArrayFromObject(UnitTester $I)
    {
        $sourceArray = [];
        for ($index = 0; $index < 3; $index++) {
            $item = new \stdClass();
            $item->id = 'id-' . ($index + 1);
            $sourceArray[] = $item;
        }

        $keyedArray = Arr::key('id', $sourceArray);
        $I->assertSame($sourceArray[0]->id, $keyedArray['id-1']->id);
        $I->assertSame($sourceArray[1]->id, $keyedArray['id-2']->id);
        $I->assertSame($sourceArray[2]->id, $keyedArray['id-3']->id);
    }

    /**
     * @param UnitTester $I
     * @throws ArrayException
     */
    public function generateGroupedKeyedArray(UnitTester $I)
    {
        $sourceArray = [
            ['id' => 'id-1'],
            ['id' => 'id-2'],
            ['id' => 'id-3'],
            ['id' => 'id-3'],
        ];

        $keyedArray = Arr::key('id', $sourceArray, true);
        $I->assertCount(1, $keyedArray['id-1']);
        $I->assertCount(1, $keyedArray['id-2']);
        $I->assertCount(2, $keyedArray['id-3']);
    }

    public function throwsExceptionsForUnsupportedValues(UnitTester $I)
    {
        $I->expectThrowable(ArrayException::class, function () {
            Arr::key('id', 1);
        });

        $I->expectThrowable(ArrayException::class, function () {
            Arr::key('id', new \stdClass());
        });

        $I->expectThrowable(ArrayException::class, function () {
            $badArray = [
                1,
                ['id' => ['id-2']],
                ['id' => 'id-3'],
            ];

            Arr::key('id', $badArray);
        });

        $I->expectThrowable(ArrayException::class, function () {
            $badArray = [
                ['id' => 'id-1'],
                ['id' => ['id-2']],
                ['id' => 'id-3'],
            ];

            Arr::key('id', $badArray);
        });

        $I->expectThrowable(ArrayException::class, function () {
            $badArray = [];
            for ($index = 0; $index < 3; $index++) {
                $item = new \stdClass();
                $item->id = ['id-' . ($index + 1)];
                $badArray[] = $item;
            }

            Arr::key('id', $badArray);
        });
    }
}
