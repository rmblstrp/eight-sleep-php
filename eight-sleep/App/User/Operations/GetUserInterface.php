<?php

namespace EightSleep\App\User\Operations;

use EightSleep\App\User\Objects\UserInterface;

interface GetUserInterface
{
    function byId(int $id): ?UserInterface;
    function byEmail(string $email): ?UserInterface;
}
