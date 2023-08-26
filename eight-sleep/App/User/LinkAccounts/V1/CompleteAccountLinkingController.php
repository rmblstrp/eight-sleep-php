<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class CompleteAccountLinkingController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return CompleteAccountLinking::class;
    }

    public function getDomainObjectClass(): ?string
    {
        return null;
    }
}
