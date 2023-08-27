<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;

class GetAccountLinkRequestEntry extends AbstractDomainOperation implements GetAccountLinkRequestEntryInterface
{
    function getByRequestingUserId(int $requestingUserId): array
    {
        return AccountLinkRequestEntry::where('requesting_user_id', $requestingUserId)->get();
    }

    function getByInvitedUserId(int $invitedUserId): array
    {
        return AccountLinkRequestEntry::where('invited_user_id', $invitedUserId)->get();
    }
}
