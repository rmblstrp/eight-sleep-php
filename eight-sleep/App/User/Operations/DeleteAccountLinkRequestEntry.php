<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class DeleteAccountLinkRequestEntry extends AbstractDomainOperation
{
    private GetAccountLinkRequestEntryInterface $getAccountLinkRequestEntry;

    public function __construct(LoggerInterface $logger, GetAccountLinkRequestEntryInterface $getAccountLinkRequestEntry)
    {
        parent::__construct($logger);

        $this->getAccountLinkRequestEntry = $getAccountLinkRequestEntry;
    }

    public function delete(int $userId, int $accountLinkRequestEntryId): void
    {
        $this->logger->debug('DeleteAccountLinkRequestEntry::delete()', [
            'userId' => $userId,
            'accountLinkRequestEntryId' => $accountLinkRequestEntryId,
        ]);
        $accountLinkRequestEntry = $this->getAccountLinkRequestEntry->getById($accountLinkRequestEntryId);
        if (!($accountLinkRequestEntry instanceof AccountLinkRequestEntryInterface)) return;
        if ($accountLinkRequestEntry->getInvitedUserId() !== $userId) return;

        $accountLinkRequestEntry->delete();
    }
}
