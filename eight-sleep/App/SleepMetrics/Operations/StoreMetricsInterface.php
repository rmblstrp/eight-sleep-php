<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;

interface StoreMetricsInterface
{
    function save(string $id, Carbon $timestamp, string $measurement, $value, array $attributes = []): void;
}
