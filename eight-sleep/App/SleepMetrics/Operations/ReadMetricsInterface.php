<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;

interface ReadMetricsInterface
{
    function getByIntervalId(int $intervalId, Carbon $intervalDateTime): ?SleepInterval;
}
