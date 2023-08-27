<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use App\EightSleep\LinkedUserAccounts;
use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\DeleteAccountLinkRequestEntry;
use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\LinkUserAccounts;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class CompleteAccountLinking extends AbstractDomainAction
{
    private LinkUserAccounts $linkUserAccounts;
    private DeleteAccountLinkRequestEntry $deleteAccountLinkRequestEntry;
    private GetAccountLinkRequestEntryInterface $getAccountLinkRequestEntry;

    public function __construct(
        LoggerInterface               $logger,
        LinkUserAccounts              $linkUserAccounts,
        DeleteAccountLinkRequestEntry $deleteAccountLinkRequestEntry,
        GetAccountLinkRequestEntryInterface $getAccountLinkRequestEntry
    )
    {
        parent::__construct($logger);

        $this->linkUserAccounts = $linkUserAccounts;
        $this->deleteAccountLinkRequestEntry = $deleteAccountLinkRequestEntry;
        $this->getAccountLinkRequestEntry = $getAccountLinkRequestEntry;
    }

    protected function handle(AccountLinkRequestEntry $accountLinkRequestEntry, DomainActionConfig $config): ?object
    {
        $entry = $this->getAccountLinkRequestEntry->getById($accountLinkRequestEntry->getId());

        if ($entry instanceof AccountLinkRequestEntryInterface) {
            $this->linkUserAccounts->link();
            $this->deleteAccountLinkRequestEntry->delete($config->getUserId(), $accountLinkRequestEntry->getId());
        }

        return null;
    }
}
