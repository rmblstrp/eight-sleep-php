<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Actions;

use EightSleep\Framework\Domain\Objects\DomainActionConfig;
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
     * @param DomainActionConfig|null $config
     *
     * @return object|null
     */
    public function execute(?object $parameters, ?DomainActionConfig $config = null): ?object
    {
        $this->logger->debug(static::class . '::execute - Calling handle', [
            'parameters' => $parameters,
            'config' => $config,
        ]);
        return call_user_func([$this, 'handle'], $parameters, $config);
    }
}
