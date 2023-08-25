<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use EightSleep\Framework\Domain\Action\AbstractDomainAction;
use Mockery;
use Psr\Log\LoggerInterface;
use UnitTester;

class AbstractDomainLogicCest
{
    public function executeCallsHandle(UnitTester $I)
    {
        /** @var LoggerInterface|Mockery\MockInterface $logger */
        $logger = Mockery::mock(LoggerInterface::class);
        $logger->expects('debug')->andReturns();
        $domainObject = new \stdClass();
        $domainLogic = new SimpleDomainLogic($logger);
        $I->assertInstanceOf(\stdClass::class, $domainLogic->execute($domainObject));
    }
}
