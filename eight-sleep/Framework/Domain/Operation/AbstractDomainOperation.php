<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Operation;

use Psr\Log\LoggerInterface;

abstract class AbstractDomainOperation
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
