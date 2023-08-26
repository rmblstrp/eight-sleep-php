<?php

namespace EightSleep\App\User\Operations;

use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class SendAccountLinkRequest extends AbstractDomainOperation
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    public function send(string $email): void
    {

    }
}
