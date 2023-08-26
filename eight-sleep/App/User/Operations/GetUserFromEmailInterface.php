<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\UserInterface;

interface GetUserFromEmailInterface
{
    function result(string $email): ?UserInterface;
}
