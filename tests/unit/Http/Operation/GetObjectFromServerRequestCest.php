<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Operation;

use EightSleep\Framework\Http\Operation\GetObjectFromServerRequest;
use EightSleep\Framework\Serialization\Json\Operation\GetObjectFromJson;
use Mockery;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use UnitTester;

class GetObjectFromServerRequestCest
{
    protected LoggerInterface $logger;
    /** @var GetObjectFromJson|Mockery\MockInterface  */
    protected GetObjectFromJson $getObjectFromJson;
    /** @var StreamInterface|Mockery\MockInterface  */
    protected StreamInterface $stream;
    /** @var ServerRequestInterface|Mockery\MockInterface  */
    protected ServerRequestInterface $request;

    public function _before(UnitTester $I)
    {
        $this->logger = Mockery::mock(LoggerInterface::class);
        $this->getObjectFromJson = Mockery::mock(GetObjectFromJson::class);
        $this->stream = Mockery::mock(StreamInterface::class);
        $this->request = Mockery::mock(ServerRequestInterface::class);
        $this->logger->expects('debug')->andReturns();
    }

    public function execute(UnitTester $I)
    {
        $json = '{"test": true}';
        $object = new \stdClass();
        $object->test = true;
        $this->request->expects('getBody')
            ->once()
            ->andReturn($this->stream);
        $this->stream->expects('getContents')
            ->once()
            ->andReturn($json);
        $this->getObjectFromJson->expects('execute')
            ->with(\stdClass::class, $json)
            ->once()
            ->andReturn($object);

        $getObjectFromServerRequest = new GetObjectFromServerRequest($this->logger, $this->getObjectFromJson);
        $result = $getObjectFromServerRequest->execute(\stdClass::class, $this->request);

        $I->assertSame($object, $result);
    }
}
