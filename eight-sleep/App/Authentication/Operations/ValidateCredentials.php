<?php

namespace EightSleep\App\Authentication\Operations;

use EightSleep\Framework\Domain\Operation\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class ValidateCredentials extends AbstractDomainOperation
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    public function isValid(string $username, string $password): bool
    {
        return false;
    }
}
