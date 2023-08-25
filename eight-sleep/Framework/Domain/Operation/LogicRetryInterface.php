<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Operation;

use EightSleep\Framework\Domain\Object\DomainObjectInterface;

interface LogicRetryInterface
{
    public function execute(string $logicClass, DomainObjectInterface $parameters): void;
}
