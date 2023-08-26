<?php

namespace EightSleep\App\User\LinkUserAccounts\V1;

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
