<?php

namespace EightSleep\App\User\Operations;

use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class SendAccountLinkNotification extends AbstractDomainOperation
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    public function send(int $userId): void
    {
        $this->logger->debug('SendAccountLinkNotification::send()', [
            'userId' => $userId,
        ]);

        // Implement logic to send a push/email/sms notification
    }
}
