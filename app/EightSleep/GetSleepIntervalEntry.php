<?php

namespace App\EightSleep;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Operations\GetSleepIntervalEntryInterface;

class GetSleepIntervalEntry implements GetSleepIntervalEntryInterface
{
    function byIntervalId(int $intervalId, ?int $userId = null): ?SleepIntervalEntry
    {
        $query = SleepIntervalEntry::where('interval_id', $intervalId);
        if (!empty($userId)) {
            $query->where('user_id', $userId);
        }

        return $query->first();
    }

    function byDateRange(int $userId, Carbon $from, Carbon $to): array
    {
        return SleepIntervalEntry::where('user_id', $userId)
            ->whereBetween('interval_datetime', [$from, $to])
            ->orderBy('interval_datetime')->get()->all();
    }
}
