<?php

namespace App\EightSleep;

use App\Models\User;
use EightSleep\App\User\Objects\UserInterface;
use EightSleep\App\User\Operations\GetUserInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class GetUser extends AbstractDomainOperation implements GetUserInterface
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    function byId(int $id): ?UserInterface
    {
        return User::where('id', $id)->first();
    }

    function byEmail(string $email): ?UserInterface
    {
        return User::where('email', $email)->first();
    }
}
