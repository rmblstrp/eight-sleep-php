<?php

namespace EightSleep\App\User\LinkUserAccounts\V1;

class AccountLinkingRequest
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
