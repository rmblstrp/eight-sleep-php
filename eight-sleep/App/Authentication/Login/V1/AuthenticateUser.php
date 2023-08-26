<?php

namespace EightSleep\App\Authentication\Login\V1;

use EightSleep\App\Authentication\Operations\ValidateCredentials;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use Psr\Log\LoggerInterface;

final class AuthenticateUser extends AbstractDomainAction
{
    private ValidateCredentials $authenticationOperation;

    public function __construct(LoggerInterface $logger, ValidateCredentials $authenticationOperation)
    {
        parent::__construct($logger);

        $this->authenticationOperation = $authenticationOperation;
    }

    protected function handle(Credentials $parameters): ?object
    {
        $isValid = $this->authenticationOperation->isValid($parameters->getUsername(), $parameters->getPassword());

        return null;
    }
}
