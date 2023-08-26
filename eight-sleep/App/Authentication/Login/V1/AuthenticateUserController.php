<?php

namespace EightSleep\App\Authentication\Login\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class AuthenticateUserController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return AuthenticateUser::class;
    }

    public function getDomainObjectClass(): string
    {
        return Credentials::class;
    }
}
