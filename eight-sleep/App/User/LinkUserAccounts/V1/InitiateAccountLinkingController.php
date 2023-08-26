<?php

namespace EightSleep\App\User\LinkUserAccounts\V1;

use EightSleep\App\SleepMetrics\SleepSession\V1\IngestSessionData;
use EightSleep\App\SleepMetrics\SleepSession\V1\SessionData;
use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class InitiateAccountLinkingController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return InitiateAccountLinking::class;
    }

    public function getDomainObjectClass(): string
    {
        return AccountLinkingRequest::class;
    }
}
