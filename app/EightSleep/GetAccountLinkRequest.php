<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;

class GetAccountLinkRequest extends AbstractDomainOperation implements GetAccountLinkRequestEntryInterface
{
    function getByRequestingUserId(int $requestingUserId): ?AccountLinkRequestEntryInterface
    {

    }

    function getByInvitedUserId(int $invitedUserId): ?AccountLinkRequestEntryInterface
    {
        // TODO: Implement getByInvitedUserId() method.
    }
}
