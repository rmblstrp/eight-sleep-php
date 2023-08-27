<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class ListLinkedUserAccountsController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return ListLinkedUserAccounts::class;
    }

    public function getDomainObjectClass(): ?string
    {
        return null;
    }
}
