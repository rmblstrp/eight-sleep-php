<?php

namespace EightSleep\App\User\Operations;

use App\EightSleep\SleepIntervalEntry;
use Carbon\Carbon;

interface GetSleepIntervalEntryInterface
{
    /**
     * @param int $userId
     * @param Carbon $from
     * @param Carbon $to
     *
     * @return SleepIntervalEntry[]
     */
    function byDateRange(int $userId, Carbon $from, Carbon $to): array;
}
