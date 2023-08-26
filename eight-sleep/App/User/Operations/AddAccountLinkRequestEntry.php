<?php

namespace EightSleep\App\User\Operations;

use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class AddAccountLinkRequestEntry extends AbstractDomainOperation
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    public function add(string $email): void
    {

    }
}
