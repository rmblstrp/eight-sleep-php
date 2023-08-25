<?php

declare(strict_types=1);

namespace Tests\Functional\Serialization\Json\Operation;

use FunctionalTester;
use JMS\Serializer\SerializerBuilder;
use EightSleep\Framework\Serialization\Json\Operation\GetObjectFromJson;
use Mockery;
use Psr\Log\LoggerInterface;

class GetObjectFromJsonCest
{
    public function execute(FunctionalTester $I)
    {
        /** @var LoggerInterface|Mockery\MockInterface $logger */
        $logger = Mockery::mock(LoggerInterface::class);
        $logger->expects('debug')->andReturns();
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        $json = '{"test_enabled":true}';

        $operation = new GetObjectFromJson($logger, $serializer);
        $result = $operation->execute(SimpleTestObject::class, $json);

        $I->assertInstanceOf(SimpleTestObject::class, $result);
        $I->assertSame(true, $result->getTestEnabled());
    }
}
