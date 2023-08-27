<?php

namespace EightSleep\App\User\LinkAccounts\V1;

use EightSleep\App\User\Operations\DeleteAccountLinkRequestEntry;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class CancelAccountLinking extends AbstractDomainAction
{
    private DeleteAccountLinkRequestEntry $deleteAccountLinkRequestEntry;

    public function __construct(LoggerInterface $logger, DeleteAccountLinkRequestEntry $deleteAccountLinkRequestEntry)
    {
        parent::__construct($logger);

        $this->deleteAccountLinkRequestEntry = $deleteAccountLinkRequestEntry;
    }

    protected function handle(?object $parameters, DomainActionConfig $config): ?object
    {
        $this->deleteAccountLinkRequestEntry->delete($config->getUserId());

        return null;
    }
}
