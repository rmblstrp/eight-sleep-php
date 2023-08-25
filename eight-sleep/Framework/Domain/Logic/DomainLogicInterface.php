<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Logic;

interface DomainLogicInterface
{
    public function execute(?object $parameters): ?object;
}
