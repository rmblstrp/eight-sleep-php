<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetUserInterface;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class ListLinkedUserAccounts extends AbstractDomainAction
{
    private GetLinkedUserAccountsInterface $getLinkedUserAccounts;
    private GetUserInterface $getUser;

    public function __construct(
        LoggerInterface $logger,
        GetLinkedUserAccountsInterface $getLinkedUserAccounts,
        GetUserInterface $getUser
    )
    {
        parent::__construct($logger);

        $this->getLinkedUserAccounts = $getLinkedUserAccounts;
        $this->getUser = $getUser;
    }

    protected function handle(?object $parameters, DomainActionConfig $config): ?object
    {
        $linkedUserAccounts = $this->getLinkedUserAccounts->getForUser($config->getUserId());

        $linkedUserIds = [];
        foreach ($linkedUserAccounts as $linkedAccount) {
            $linkedUserIds[] = $linkedAccount->getOriginatingUserId() == $config->getUserId()
                ? $linkedAccount->getLinkedUserId()
                : $linkedAccount->getOriginatingUserId();
        }

        $linkedUsers = [];
        foreach ($linkedUserIds as $userId) {
            $user = $this->getUser->byId($userId);
            $linkedUsers[] = new LinkedUser($user->getId(), $user->getName());
        }

        return new LinkedUserAccountList($linkedUsers);
    }
}
