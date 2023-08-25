<?php

declare(strict_types=1);

namespace Tests\Functional\Serialization\Json\Operation;

use FunctionalTester;
use JMS\Serializer\SerializerBuilder;
use EightSleep\Framework\Serialization\Json\Operation\SerializeObjectToJson;
use Mockery;
use Psr\Log\LoggerInterface;

class SerializeObjectToJsonCest
{
    public function execute(FunctionalTester $I)
    {
        /** @var LoggerInterface|Mockery\MockInterface $logger */
        $logger = Mockery::mock(LoggerInterface::class);
        $logger->expects('debug')->andReturns();
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        $object = (new SimpleTestObject())->setTestEnabled(true);

        $operation = new SerializeObjectToJson($logger, $serializer);
        $result = $operation->execute($object);

        $I->assertSame('{"test_enabled":true}', $result);
    }
}
