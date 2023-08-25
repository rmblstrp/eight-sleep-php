<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Action;

use Psr\Log\LoggerInterface;

abstract class AbstractDomainAction implements DomainActionInterface
{
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Calls child class method handle to allow for specific request object type declaration
     *
     * @param object|null $parameters
     * @return object|null
     */
    public function execute(?object $parameters): ?object
    {
        $this->logger->debug(static::class . '::execute - Calling handle', [
            'parameters' => $parameters,
        ]);
        return call_user_func([$this, 'handle'], $parameters);
    }
}
