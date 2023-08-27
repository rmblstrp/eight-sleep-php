<?php

namespace EightSleep\App\User\Operations;

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

    public function delete(int $userId): void
    {
        foreach ($this->getAccountLinkRequestEntry->getByRequestingUserId($userId) as $entry) {
            $entry->delete();
        }

        foreach ($this->getAccountLinkRequestEntry->getByInvitedUserId($userId) as $entry) {
            $entry->delete();
        }
    }
}
