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
    private UserAccountsAreLinked $userAccountsAreLinked;

    public function __construct(
        LoggerInterface $logger,
        ClassFactoryInterface $classFactory,
        UserAccountsAreLinked $userAccountsAreLinked
    )
    {
        parent::__construct($logger);

        $this->classFactory = $classFactory;
        $this->userAccountsAreLinked = $userAccountsAreLinked;
    }

    public function link(int $originatingUserId, int $linkedUserId): void
    {
        $this->logger->debug('AddAccountLinkRequestEntry::add()', [
            'originatingUserId' => $originatingUserId,
            'invitedUserId'    => $linkedUserId,
        ]);

        if ($this->userAccountsAreLinked->isTrue($originatingUserId, $linkedUserId)) return;

        /** @var LinkedUserAccountsInterface $linkedUserAccounts */
        $linkedUserAccounts = $this->classFactory->make(LinkedUserAccountsInterface::class);
        $linkedUserAccounts
            ->setOriginatingUserId($originatingUserId)
            ->setLinkedUserId($linkedUserId)
            ->persist();

        $this->logger->debug('PERSISTED');
        $this->logger->debug(var_export($linkedUserAccounts, true));
    }
}
