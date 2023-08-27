<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class CancelAccountLinkingController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return CancelAccountLinking::class;
    }

    public function getDomainObjectClass(): ?string
    {
        return AccountLinkRequestEntry::class;
    }
}
