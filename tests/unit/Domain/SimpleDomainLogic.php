<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use EightSleep\Framework\Domain\Actions\AbstractDomainAction;

class SimpleDomainLogic extends AbstractDomainAction
{
    protected function handle(?object $parameters): ?object
    {
        return $parameters;
    }
}
