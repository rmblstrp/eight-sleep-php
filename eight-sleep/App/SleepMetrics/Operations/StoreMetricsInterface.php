<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;

interface StoreMetricsInterface
{
    function save(int $userId, Carbon $timestamp, string $measurement, string $value, array $attributes = []);
}
