<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Operation;

use GuzzleHttp\Psr7\Response;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use EightSleep\Framework\Http\Enum\ContentType;
use EightSleep\Framework\Http\Enum\HttpHeader;
use EightSleep\Framework\Http\Enum\HttpStatusCode;
use EightSleep\Framework\Serialization\Json\Operation\SerializeObjectToJson;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use stdClass;

class CreateResponseFromObject extends AbstractDomainOperation
{
    protected SerializeObjectToJson $serializeObjectToJson;

    /**
     * @param LoggerInterface $logger
     * @param SerializeObjectToJson $serializeObjectToJson
     */
    public function __construct(LoggerInterface $logger, SerializeObjectToJson $serializeObjectToJson)
    {
        parent::__construct($logger);
        $this->serializeObjectToJson = $serializeObjectToJson;
    }

    /**
     * @param object|null $object
     * @param HttpStatusCode $statusCode
     * @param array $headers
     * @return ResponseInterface
     */
    public function execute(?object $object, HttpStatusCode $statusCode, array $headers = []): ResponseInterface
    {
        $headers = array_replace([HttpHeader::CONTENT_TYPE => ContentType::APPLICATION_JSON], $headers);
        $json = $this->serializeObjectToJson->execute($object ?? new stdClass());

        $this->logger->debug(self::class . '::execute - Creating Response Object', [
            'status' => $statusCode->getValue(),
            'headers' => $headers,
            'content' => $json,
        ]);
        return new Response($statusCode->getValue(), $headers, $json);
    }
}
