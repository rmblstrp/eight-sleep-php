<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\Framework\Domain\ClassFactoryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class AddAccountLinkRequestEntry extends AbstractDomainOperation
{
    private ClassFactoryInterface $classFactory;

    public function __construct(LoggerInterface $logger, ClassFactoryInterface $classFactory)
    {
        parent::__construct($logger);

        $this->classFactory = $classFactory;
    }

    public function add(int $requestingUserId, int $invitedUserId): int
    {
        $this->logger->debug('AddAccountLinkRequestEntry::add()', [
            'requestingUserId' => $requestingUserId,
            'invitedUserId' => $invitedUserId,
        ]);

        /** @var AccountLinkRequestEntryInterface $accountLinkingRequest */
        $accountLinkingRequest = $this->classFactory->make(AccountLinkRequestEntryInterface::class);
        $accountLinkingRequest
            ->setOriginatingUserId($requestingUserId)
            ->setInvitedUserId($invitedUserId)
            ->persist();

        return $accountLinkingRequest->getId();
    }
}
