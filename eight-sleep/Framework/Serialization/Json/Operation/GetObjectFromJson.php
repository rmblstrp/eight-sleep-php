<?php

declare(strict_types=1);

namespace EightSleep\Framework\Serialization\Json\Operation;

use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;

class GetObjectFromJson extends AbstractDomainOperation
{
    protected SerializerInterface $serializer;

    /**
     * @param LoggerInterface $logger
     * @param SerializerInterface $serializer
     */
    public function __construct(LoggerInterface $logger, SerializerInterface $serializer)
    {
        parent::__construct($logger);
        $this->serializer = $serializer;
    }

    public function execute(string $class, string $json): object
    {
//        $this->logger->debug(self::class . '::execute - Deserializating JSON to Object', [
//            'class' => $class,
//            'json' => $json
//        ]);
        return $this->serializer->deserialize($json, $class, 'json');
    }
}
