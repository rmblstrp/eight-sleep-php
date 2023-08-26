<?php

namespace EightSleep\App\User\LinkUserAccounts\V1;

use EightSleep\App\User\Objects\UserInterface;
use EightSleep\App\User\Operations\GetUserFromEmailInterface;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use Psr\Log\LoggerInterface;

class InitiateAccountLinking extends AbstractDomainAction
{
    private GetUserFromEmailInterface $userEmailExists;

    public function __construct(LoggerInterface $logger, GetUserFromEmailInterface $userEmailExists)
    {
        parent::__construct($logger);

        $this->userEmailExists = $userEmailExists;
    }

    protected function handle(AccountLinkingRequest $request): ?object
    {
        $user = $this->userEmailExists->result($request->getEmail());
        if ($user instanceof UserInterface) {

        }

        return null;
    }
}
