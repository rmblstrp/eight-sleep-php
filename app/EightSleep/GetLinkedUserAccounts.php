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
        LinkedUserAccounts::where('id', $id)->first();
    }

    function getForLinkedUsers(int $user1, int $user2): ?LinkedUserAccountsInterface
    {
        return LinkUserAccounts::where(function (Builder $query) use ($user1, $user2) {
            $query
                ->where('originating_user_id', $user1)
                ->orWhere('invited_user_id', $user2);
        })->orWhere(function (Builder $query) use ($user1, $user2) {
            $query
                ->where('originating_user_id', $user2)
                ->orWhere('invited_user_id', $user1);
        })->first();
    }
}
