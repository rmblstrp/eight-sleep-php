<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Action;

interface DomainActionInterface
{
    public function execute(?object $parameters): ?object;
}
