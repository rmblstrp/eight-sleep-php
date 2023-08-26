<?php

namespace EightSleep\App\User\Objects;

use EightSleep\Framework\Domain\Objects\DeletableModelInterface;
use EightSleep\Framework\Domain\Objects\PersistableModelInterface;

interface AccountLinkRequestEntryInterface extends PersistableModelInterface, DeletableModelInterface
{
    function getRequestingUserId(): int;
    function setRequestingUserId(int $requestingUserId): AccountLinkRequestEntryInterface;

    function getInvitedUserId(): int;
    function setInvitedUserId(int $invitedUserId): AccountLinkRequestEntryInterface;
}
