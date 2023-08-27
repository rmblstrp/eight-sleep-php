<?php

namespace EightSleep\App\User\LinkAccounts\V1;

class AccountLinkRequestList
{
    /**
     * @var int[]
     */
    private array $ids = [];

    /**
     * @param int[] $ids
     */
    public function __construct(array $ids = [])
    {
        $this->ids = $ids;
    }

    /**
     * @return int[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }
}
