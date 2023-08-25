<?php

declare(strict_types=1);

namespace Tests\Unit\Serialization\Json\Operation;

use JMS\Serializer\SerializerInterface;
use EightSleep\Framework\Serialization\Json\Operation\GetObjectFromJson;
use Mockery;
use Psr\Log\LoggerInterface;
use UnitTester;

class GetObjectFromJsonCest
{
    protected LoggerInterface $logger;
    /** @var SerializerInterface|Mockery\MockInterface  */
    protected SerializerInterface $serializer;

    public function _before(UnitTester $I)
    {
        $this->logger = Mockery::mock(LoggerInterface::class);
        $this->serializer = Mockery::mock(SerializerInterface::class);
        $this->logger->expects('debug')->andReturns();
    }

    public function execute(UnitTester $I)
    {
        $json = '{"test": true}';
        $object = new \stdClass();
        $object->test = true;
        $this->serializer->expects('deserialize')
            ->with($json, \stdClass::class, 'json')
            ->once()
            ->andReturn($object);

        $operation = new GetObjectFromJson($this->logger, $this->serializer);
        $result = $operation->execute(\stdClass::class, $json);

        $I->assertSame($object, $result);
    }
}
