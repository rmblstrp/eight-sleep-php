<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use JMS\Serializer\Annotation as Serializer;

class LinkedUserAccountList
{
    /** @var LinkedUser[] */
    private array $users = [];

    /**
     * @param LinkedUser[] $users
     */
    public function __construct(array $users = [])
    {
        $this->users = $users;
    }

    /**
     * @return LinkedUser[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
