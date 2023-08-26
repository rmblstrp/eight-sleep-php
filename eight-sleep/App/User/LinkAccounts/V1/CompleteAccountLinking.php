<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use Psr\Log\LoggerInterface;

class CompleteAccountLinking extends AbstractDomainAction
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}
