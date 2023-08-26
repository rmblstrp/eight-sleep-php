<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepIntervalEntryInterface;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;
use EightSleep\Framework\Domain\ClassFactoryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class AddSleepIntervalEntry extends AbstractDomainOperation
{
    private ClassFactoryInterface $classFactory;

    public function __construct(LoggerInterface $logger, ClassFactoryInterface $classFactory)
    {
        parent::__construct($logger);

        $this->classFactory = $classFactory;
    }

    public function add(int $userId, SleepInterval $sleepInterval): void
    {
        $this->logger->debug('AddSleepIntervalEntry::add()', [
            'userId' => $userId,
            'sleepInterval' => $sleepInterval
        ]);

        /** @var SleepIntervalEntryInterface $entry */
        $entry = $this->classFactory->make(SleepIntervalEntryInterface::class);
        $entry
            ->setUserId($userId)
            ->setIntervalId(intval($sleepInterval->getId()))
            ->setIntervalDateTime(Carbon::createFromTimeString($sleepInterval->getTs()))
            ->persist();
    }
}
