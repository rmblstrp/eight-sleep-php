<?php

namespace EightSleep\App\User\LinkUserAccounts\V1;

use EightSleep\App\User\Objects\UserInterface;
use EightSleep\App\User\Operations\AddAccountLinkRequestEntry;
use EightSleep\App\User\Operations\GetUserFromEmailInterface;
use EightSleep\App\User\Operations\SendAccountLinkNotification;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class InitiateAccountLinking extends AbstractDomainAction
{
    private GetUserFromEmailInterface $userEmailExists;
    private AddAccountLinkRequestEntry $addAccountLinkRequestEntry;
    private SendAccountLinkNotification $sendAccountLinkNotification;

    public function __construct(
        LoggerInterface $logger,
        GetUserFromEmailInterface $userEmailExists,
        AddAccountLinkRequestEntry $addAccountLinkRequestEntry,
        SendAccountLinkNotification $sendAccountLinkNotification
    )
    {
        parent::__construct($logger);

        $this->userEmailExists = $userEmailExists;
        $this->addAccountLinkRequestEntry = $addAccountLinkRequestEntry;
        $this->sendAccountLinkNotification = $sendAccountLinkNotification;
    }

    protected function handle(AccountLinkingRequest $request, DomainActionConfig $config): ?object
    {
        $invitedUser = $this->userEmailExists->result($request->getEmail());
        if ($invitedUser instanceof UserInterface) {
            $this->addAccountLinkRequestEntry->add($config->getUserId(), $invitedUser->getId());
            $this->sendAccountLinkNotification->send($invitedUser->getId());
        }

        return null;
    }
}
