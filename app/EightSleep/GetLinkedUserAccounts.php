<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\App\User\Operations\LinkUserAccounts;
use Illuminate\Database\Query\Builder;

class GetLinkedUserAccounts implements GetLinkedUserAccountsInterface
{

    function getById(int $id): ?LinkedUserAccountsInterface
    {
        return LinkedUserAccounts::where('id', $id)->first();
    }

    function getForLinkedUsers(int $userId1, int $userId2): ?LinkedUserAccountsInterface
    {
        return LinkUserAccounts::where(function (Builder $query) use ($userId1, $userId2) {
            $query
                ->where('originating_user_id', $userId1)
                ->orWhere('linked_user_id', $userId2);
        })->orWhere(function (Builder $query) use ($userId1, $userId2) {
            $query
                ->where('originating_user_id', $userId2)
                ->orWhere('linked_user_id', $userId1);
        })->first();
    }

    function getForUser(int $userId): ?LinkedUserAccountsInterface
    {
        return LinkedUserAccounts::where('originating_user_id', $userId)
            ->orWhere('linked_user_id', $userId)
            ->get()->all();
    }
}
