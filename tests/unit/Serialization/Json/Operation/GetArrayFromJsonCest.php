<?php

declare(strict_types=1);

namespace Tests\Unit\Serialization\Json\Operation;

use EightSleep\Framework\Serialization\Json\Operation\GetArrayFromJson;
use Mockery;
use Psr\Log\LoggerInterface;
use UnitTester;

class GetArrayFromJsonCest
{
    protected LoggerInterface $logger;

    public function _before(UnitTester $I)
    {
        $this->logger = Mockery::mock(LoggerInterface::class);
        $this->logger->expects('debug')->andReturns();
    }

    public function execute(UnitTester $I)
    {
        $json = '{"test": true}';
        $expected = ['test' => true];

        $operation = new GetArrayFromJson($this->logger);
        $result = $operation->execute($json);

        $I->assertSame($expected, $result);
    }
}
