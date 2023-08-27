<?php

namespace EightSleep\App\User\LinkAccounts\V1;

class AccountLinkRequestEntry
{
    private int $id;

    /**
     * @param int $id
     */
    public function __construct(int $id = -1)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
