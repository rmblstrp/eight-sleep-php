<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;

interface GetAccountLinkRequestEntryInterface
{
    /**
     * @param int $requestingUserId
     *
     * @return AccountLinkRequestEntryInterface[]
     */
    function getByRequestingUserId(int $requestingUserId): array;

    /**
     * @param int $invitedUserId
     *
     * @return AccountLinkRequestEntryInterface[]
     */
    function getByInvitedUserId(int $invitedUserId): array;
}
