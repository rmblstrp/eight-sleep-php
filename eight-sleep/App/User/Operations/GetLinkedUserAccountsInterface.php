<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\LinkedUserAccountsInterface;

interface GetLinkedUserAccountsInterface
{
    function getById(int $id): ?LinkedUserAccountsInterface;

    function getForLinkedUsers(int $user1, int $user2): ?LinkedUserAccountsInterface;
}
