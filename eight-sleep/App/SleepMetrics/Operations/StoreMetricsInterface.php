<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepMetric;

interface StoreMetricsInterface
{
    function save(SleepMetric $sleepMetric): void;
}
