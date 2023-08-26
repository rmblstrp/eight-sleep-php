<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;

interface GetAccountLinkRequestEntryInterface
{
    function getByRequestingUserId(int $requestingUserId): ?AccountLinkRequestEntryInterface;
    function getByInvitedUserId(int $invitedUserId): ?AccountLinkRequestEntryInterface;
}
