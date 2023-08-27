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

    public function __construct(LoggerInterface $logger, ClassFactoryInterface $classFactory)
    {
        parent::__construct($logger);

        $this->classFactory = $classFactory;
    }

    public function link(int $originatingUserId, int $invitedUserId): void
    {
        $this->logger->debug('AddAccountLinkRequestEntry::add()', [
            'originatingUserId' => $originatingUserId,
            'invitedUserId'    => $invitedUserId,
        ]);

        /** @var LinkedUserAccountsInterface $linkedUserAccounts */
        $linkedUserAccounts = $this->classFactory->make(LinkedUserAccountsInterface::class);
        $linkedUserAccounts
            ->setOriginatingUserId($originatingUserId)
            ->setLinkedUserId($invitedUserId)
            ->persist();
    }
}
