<?php

namespace EightSleep\App\SleepMetrics\Operations;

use App\EightSleep\SleepIntervalEntry;
use Carbon\Carbon;

interface GetSleepIntervalEntryInterface
{
    function byIntervalId(int $intervalId, ?int $userId = null): ?SleepIntervalEntry;

    /**
     * @param int $userId
     * @param Carbon $from
     * @param Carbon $to
     *
     * @return SleepIntervalEntry[]
     */
    function byDateRange(int $userId, Carbon $from, Carbon $to): array;
}
