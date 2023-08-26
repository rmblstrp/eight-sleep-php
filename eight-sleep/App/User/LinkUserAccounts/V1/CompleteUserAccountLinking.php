<?php

namespace EightSleep\App\User\LinkUserAccounts\V1;

use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use Psr\Log\LoggerInterface;

class CompleteUserAccountLinking extends AbstractDomainAction
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}
