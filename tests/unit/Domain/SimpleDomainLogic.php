<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use EightSleep\Framework\Domain\Logic\AbstractDomainLogic;

class SimpleDomainLogic extends AbstractDomainLogic
{
    protected function handle(?object $parameters): ?object
    {
        return $parameters;
    }
}
