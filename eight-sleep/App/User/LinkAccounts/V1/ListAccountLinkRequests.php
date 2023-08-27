<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class ListAccountLinkRequests extends AbstractDomainAction
{
    private GetAccountLinkRequestEntryInterface $getAccountLinkRequestEntry;

    public function __construct(LoggerInterface $logger, GetAccountLinkRequestEntryInterface $getAccountLinkRequestEntry)
    {
        parent::__construct($logger);

        $this->getAccountLinkRequestEntry = $getAccountLinkRequestEntry;
    }

    protected function handle(?object $parameters, DomainActionConfig $config): ?object
    {
        $linkRequestIds = [];

        $linkRequests = $this->getAccountLinkRequestEntry->getByInvitedUserId($config->getUserId());
        foreach ($linkRequests as $request) {
            $linkRequestIds[] = $request->getId();
        }

        return new AccountLinkRequestList($linkRequestIds);
    }
}
