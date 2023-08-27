<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class ListLinkedUserAccounts extends AbstractDomainAction
{
    private GetLinkedUserAccountsInterface $getLinkedUserAccounts;

    public function __construct(LoggerInterface $logger, GetLinkedUserAccountsInterface $getLinkedUserAccounts)
    {
        parent::__construct($logger);

        $this->getLinkedUserAccounts = $getLinkedUserAccounts;
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

        return new LinkedUserAccountList($linkedUserIds);
    }
}
