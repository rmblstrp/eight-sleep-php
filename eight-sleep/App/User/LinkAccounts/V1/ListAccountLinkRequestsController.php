<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class ListAccountLinkRequestsController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return ListAccountLinkRequests::class;
    }

    public function getDomainObjectClass(): ?string
    {
        return null;
    }
}
