<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\LinkedUserAccountsInterface;

interface GetLinkedUserAccountsInterface
{
    function getById(int $id): ?LinkedUserAccountsInterface;

    function getForLinkedUsers(int $userId1, int $userId2): ?LinkedUserAccountsInterface;

    /**
     * @param int $userId
     *
     * @return LinkedUserAccountsInterface[]
     */
    function getForUser(int $userId): array;
}
