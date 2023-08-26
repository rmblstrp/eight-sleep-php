<?php

namespace EightSleep\App\User\Objects;

use EightSleep\Framework\Domain\Objects\PersistableModelInterface;

interface UserInterface extends PersistableModelInterface
{
    function getId(): int;
    function getName(): string;
    function setName(string $name): UserInterface;
    function getEmail(): string;
    function setEmail(string $email): UserInterface;
    function getPassword(): string;
    function setPassword(string $password): UserInterface;
}
