<?php

namespace EightSleep\App\SleepMetrics\Operations;

use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;

interface ReadMetricsInterface
{
    function getByIntervalId(int $intervalId): ?SleepInterval;
}
