<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Illuminate\Database\Eloquent\Collection;

class GetAccountLinkRequestEntry extends AbstractDomainOperation implements GetAccountLinkRequestEntryInterface
{
    function getById(int $id): ?AccountLinkRequestEntryInterface
    {
        return AccountLinkRequestEntry::where('id', $id)->first();
    }

    function getByRequestingUserId(int $requestingUserId): array
    {
        return AccountLinkRequestEntry::where('requesting_user_id', $requestingUserId)->get()->all();
    }

    function getByInvitedUserId(int $invitedUserId): array
    {
        return AccountLinkRequestEntry::where('invited_user_id', $invitedUserId)->get()->all();
    }
}
