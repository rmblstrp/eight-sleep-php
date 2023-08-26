<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Operation;

use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use EightSleep\Framework\Serialization\Json\Operation\GetObjectFromJson;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class GetObjectFromServerRequest extends AbstractDomainOperation
{
    protected GetObjectFromJson $getObjectFromJson;

    /**
     * @param LoggerInterface $logger
     * @param GetObjectFromJson $getObjectFromJson
     */
    public function __construct(LoggerInterface $logger, GetObjectFromJson $getObjectFromJson)
    {
        parent::__construct($logger);
        $this->getObjectFromJson = $getObjectFromJson;
    }

    /**
     * @param string $class
     * @param ServerRequestInterface $request
     * @return object|null
     */
    public function execute(string $class, ServerRequestInterface $request): ?object
    {
        $this->logger->debug(self::class . '::execute', [
            'class' => $class,
            'request' => $request
        ]);
        $json = $request->getBody()->getContents();
        return $this->getObjectFromJson->execute($class, $json);
    }
}
