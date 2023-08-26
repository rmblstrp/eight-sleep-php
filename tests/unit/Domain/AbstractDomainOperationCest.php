<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Mockery;
use UnitTester;

class AbstractDomainOperationCest
{
    public function make(UnitTester $I)
    {
        $instance = Mockery::mock(AbstractDomainOperation::class)->makePartial();
        $I->assertInstanceOf(AbstractDomainOperation::class, $instance);
    }
}
