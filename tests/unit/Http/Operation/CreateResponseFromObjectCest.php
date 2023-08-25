<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Operation;

use EightSleep\Framework\Http\Enum\ContentType;
use EightSleep\Framework\Http\Enum\HttpHeader;
use EightSleep\Framework\Http\Enum\HttpStatusCode;
use EightSleep\Framework\Http\Operation\CreateResponseFromObject;
use EightSleep\Framework\Serialization\Json\Operation\SerializeObjectToJson;
use Mockery;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use UnitTester;

class CreateResponseFromObjectCest
{
    protected LoggerInterface $logger;
    /** @var SerializeObjectToJson|Mockery\MockInterface  */
    protected SerializeObjectToJson $serializeObjectToJson;

    public function _before(UnitTester $I)
    {
        $this->logger = Mockery::mock(LoggerInterface::class);
        $this->serializeObjectToJson = Mockery::mock(SerializeObjectToJson::class);
        $this->logger->expects('debug')->andReturns();
    }

    public function execute(UnitTester $I)
    {
        $object = new \stdClass();
        $object->test = true;
        $json = '{"test": true}';
        $this->serializeObjectToJson->expects('execute')
            ->with($object)
            ->once()
            ->andReturn($json);
        $createResponseFromObject = new CreateResponseFromObject($this->logger, $this->serializeObjectToJson);

        $response = $createResponseFromObject->execute($object, HttpStatusCode::IM_A_TEAPOT());
        $I->assertInstanceOf(ResponseInterface::class, $response);
        $I->assertSame(ContentType::APPLICATION_JSON, $response->getHeader(HttpHeader::CONTENT_TYPE)[0]);
        $I->assertSame(HttpStatusCode::IM_A_TEAPOT, $response->getStatusCode());
        $I->assertSame($json, $response->getBody()->getContents());
    }

    public function executeWithNullObject(UnitTester $I)
    {
        $object = null;
        $json = '{}';
        $this->serializeObjectToJson->expects('execute')
            ->with(anInstanceOf(\stdClass::class))
            ->once()
            ->andReturn($json);
        $createResponseFromObject = new CreateResponseFromObject($this->logger, $this->serializeObjectToJson);

        $response = $createResponseFromObject->execute($object, HttpStatusCode::IM_A_TEAPOT());
        $I->assertSame($json, $response->getBody()->getContents());
    }
}
