<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepMetric;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class GetSleepIntervalFromMetrics extends AbstractDomainOperation
{
    private ReadMetricsInterface $readMetrics;

    public function __construct(LoggerInterface $logger, ReadMetricsInterface $readMetrics)
    {
        parent::__construct($logger);

        $this->readMetrics = $readMetrics;
    }

    public function get(int $intervalId): array
    {

    }
}
