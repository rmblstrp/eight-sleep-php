<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Operations\GetSleepIntervalEntryInterface;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class ListSleepIntervals extends AbstractDomainAction
{
    private GetSleepIntervalEntryInterface $getSleepIntervalEntry;

    public function __construct(LoggerInterface $logger, GetSleepIntervalEntryInterface $getSleepIntervalEntry)
    {
        parent::__construct($logger);

        $this->getSleepIntervalEntry = $getSleepIntervalEntry;
    }

    protected function handle(ListSleepIntervalRange $listSleepIntervalRange, DomainActionConfig $config): ?object
    {
        $intervals = $this->getSleepIntervalEntry->byDateRange(
            $config->getUserId(),
            Carbon::createFromTimeString($listSleepIntervalRange->getFrom()),
            Carbon::createFromTimeString($listSleepIntervalRange->getTo()));

        $intervalIds = [];
        foreach ($intervals as $interval) {
            $intervalIds[] = $interval->getIntervalId();
        }

        return null;
    }
}
