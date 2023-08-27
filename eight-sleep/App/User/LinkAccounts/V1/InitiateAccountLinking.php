<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\App\User\Objects\UserInterface;
use EightSleep\App\User\Operations\AddAccountLinkRequestEntry;
use EightSleep\App\User\Operations\GetUserInterface;
use EightSleep\App\User\Operations\SendAccountLinkNotification;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class InitiateAccountLinking extends AbstractDomainAction
{
    private GetUserInterface $userEmailExists;
    private AddAccountLinkRequestEntry $addAccountLinkRequestEntry;
    private SendAccountLinkNotification $sendAccountLinkNotification;

    public function __construct(
        LoggerInterface             $logger,
        GetUserInterface            $userEmailExists,
        AddAccountLinkRequestEntry  $addAccountLinkRequestEntry,
        SendAccountLinkNotification $sendAccountLinkNotification
    )
    {
        parent::__construct($logger);

        $this->userEmailExists = $userEmailExists;
        $this->addAccountLinkRequestEntry = $addAccountLinkRequestEntry;
        $this->sendAccountLinkNotification = $sendAccountLinkNotification;
    }

    protected function handle(RequestAccountLinking $request, DomainActionConfig $config): ?object
    {
        $invitedUser = $this->userEmailExists->byEmail($request->getEmail());
        if ($invitedUser instanceof UserInterface) {
            $entryId = $this->addAccountLinkRequestEntry->add($config->getUserId(), $invitedUser->getId());
            $this->sendAccountLinkNotification->send($invitedUser->getId());

            return new AccountLinkRequestEntry($entryId);
        }

        return null;
    }
}
