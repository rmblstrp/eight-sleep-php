<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use Illuminate\Database\Eloquent\Builder;

class GetLinkedUserAccounts implements GetLinkedUserAccountsInterface
{

    function getById(int $id): ?LinkedUserAccountsInterface
    {
        return LinkedUserAccounts::where('id', $id)->first();
    }

    function getForLinkedUsers(int $userId1, int $userId2): ?LinkedUserAccountsInterface
    {
        return LinkedUserAccounts::where(function (Builder $query) use ($userId1, $userId2) {
            $query
                ->where('originating_user_id', $userId1)
                ->where('linked_user_id', $userId2);
        })->orWhere(function (Builder $query) use ($userId1, $userId2) {
            $query
                ->where('originating_user_id', $userId2)
                ->where('linked_user_id', $userId1);
        })->first();
    }

    function getForUser(int $userId): array
    {
        return LinkedUserAccounts::where('originating_user_id', $userId)
            ->orWhere('linked_user_id', $userId)
            ->get()->all();
    }
}
