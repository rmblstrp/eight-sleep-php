<?php

namespace EightSleep\App\Authentication\Login\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class LoginController extends AbstractDomainActionController
{

    public function getDomainActionClass(): string
    {
        return LoginAction::class;
    }

    public function getDomainObjectClass(): string
    {
        return Credentials::class;
    }
}
