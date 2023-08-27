<?php

namespace App\EightSleep;

use Carbon\Carbon;
use EightSleep\App\User\Operations\GetSleepIntervalEntryInterface;

class GetSleepIntervalEntry implements GetSleepIntervalEntryInterface
{
    function byDateRange(int $userId, Carbon $from, Carbon $to): array
    {
        return SleepIntervalEntry::where('user_id', $userId)
            ->whereBetween('interval_datetime', [$from, $to])
            ->orderBy('interval_datetime')->get()->all();
    }
}
