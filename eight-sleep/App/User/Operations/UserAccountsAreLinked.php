<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class UserAccountsAreLinked extends AbstractDomainOperation
{
    private GetLinkedUserAccountsInterface $getLinkedUserAccounts;

    public function __construct(LoggerInterface $logger, GetLinkedUserAccountsInterface $getLinkedUserAccounts)
    {
        parent::__construct($logger);

        $this->getLinkedUserAccounts = $getLinkedUserAccounts;
    }

    public function isTrue(int $userId, int $linkedUserId): bool
    {
        $linkedUserAccounts = $this->getLinkedUserAccounts->getForLinkedUsers($userId, $linkedUserId);
        return $linkedUserAccounts instanceof LinkedUserAccountsInterface;
    }
}
