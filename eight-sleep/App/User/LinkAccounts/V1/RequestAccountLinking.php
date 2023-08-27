<?php

namespace EightSleep\App\User\LinkAccounts\V1;

class RequestAccountLinking
{
    private string $email = '';

    /**
     * @param string $email
     */
    public function __construct(string $email = '')
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
