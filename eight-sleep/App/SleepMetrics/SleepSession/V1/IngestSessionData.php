<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\App\SleepMetrics\Operations\AddSleepIntervalEntry;
use EightSleep\App\SleepMetrics\Operations\AddSleepIntervalMetrics;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

final class IngestSessionData extends AbstractDomainAction
{
    private AddSleepIntervalEntry $addSleepInterval;
    private AddSleepIntervalMetrics $addSleepIntervalMetrics;

    public function __construct(
        LoggerInterface         $logger,
        AddSleepIntervalEntry   $addSleepInterval,
        AddSleepIntervalMetrics $addSleepIntervalMetrics
    )
    {
        parent::__construct($logger);

        $this->addSleepInterval = $addSleepInterval;
        $this->addSleepIntervalMetrics = $addSleepIntervalMetrics;
    }

    protected function handle(SessionData $sessionData, DomainActionConfig $config): ?object
    {
        foreach ($sessionData->getIntervals() as $sleepInterval) {
            $this->addSleepInterval->add($config->getUserId(), $sleepInterval);
            $this->addSleepIntervalMetrics->add($sleepInterval);
        }

        return null;
    }
}
