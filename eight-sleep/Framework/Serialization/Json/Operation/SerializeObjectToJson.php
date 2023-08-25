<?php

declare(strict_types=1);

namespace EightSleep\Framework\Serialization\Json\Operation;

use JMS\Serializer\SerializerInterface;
use EightSleep\Framework\Domain\Operation\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class SerializeObjectToJson extends AbstractDomainOperation
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

    /**
     * @param object|null $object
     * @return string
     */
    public function execute(?object $object): string
    {
        $this->logger->debug(self::class . '::execute - Serializing Object to JSON');
        return $this->serializer->serialize($object, 'json');
    }
}
