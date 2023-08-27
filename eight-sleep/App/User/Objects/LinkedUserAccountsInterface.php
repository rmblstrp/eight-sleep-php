<?php

namespace EightSleep\App\User\Objects;

use EightSleep\Framework\Domain\Objects\DeletableModelInterface;
use EightSleep\Framework\Domain\Objects\PersistableModelInterface;

interface LinkedUserAccountsInterface extends PersistableModelInterface, DeletableModelInterface
{
    function getOriginatingUserId(): int;
    function setOriginatingUserId(int $originatingUserId): LinkedUserAccountsInterface;

    function getLinkedUserId(): int;
    function setLinkedUserId(int $linkedUserId): LinkedUserAccountsInterface;
}
