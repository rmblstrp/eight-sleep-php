<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Actions;

use EightSleep\Framework\Domain\Objects\DomainActionConfig;

interface DomainActionInterface
{
    public function execute(?object $parameters, ?DomainActionConfig $config = null): ?object;
}
