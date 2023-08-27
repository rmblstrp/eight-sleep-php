<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\Framework\Domain\ClassFactoryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class LinkUserAccounts extends AbstractDomainOperation
{
    private ClassFactoryInterface $classFactory;
    private GetLinkedUserAccountsInterface $getLinkedUserAccounts;

    public function __construct(
        LoggerInterface $logger,
        ClassFactoryInterface $classFactory,
        GetLinkedUserAccountsInterface $getLinkedUserAccounts
    )
    {
        parent::__construct($logger);

        $this->classFactory = $classFactory;
        $this->getLinkedUserAccounts = $getLinkedUserAccounts;
    }

    public function link(int $originatingUserId, int $linkedUserId): void
    {
        $this->logger->debug('AddAccountLinkRequestEntry::add()', [
            'originatingUserId' => $originatingUserId,
            'invitedUserId'    => $linkedUserId,
        ]);

        if (!empty($this->getLinkedUserAccounts->getForLinkedUsers($originatingUserId, $linkedUserId))) return;

        /** @var LinkedUserAccountsInterface $linkedUserAccounts */
        $linkedUserAccounts = $this->classFactory->make(LinkedUserAccountsInterface::class);
        $linkedUserAccounts
            ->setOriginatingUserId($originatingUserId)
            ->setLinkedUserId($linkedUserId)
            ->persist();
    }
}
