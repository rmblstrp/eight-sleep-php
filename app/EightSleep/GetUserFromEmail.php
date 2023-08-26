<?php

namespace App\EightSleep;

use App\Models\User;
use EightSleep\App\User\Objects\UserInterface;
use EightSleep\App\User\Operations\GetUserFromEmailInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class GetUserFromEmail extends AbstractDomainOperation implements GetUserFromEmailInterface
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    function result(string $email): ?UserInterface
    {
        return User::where('email', $email)->take(1)->get();
    }
}
