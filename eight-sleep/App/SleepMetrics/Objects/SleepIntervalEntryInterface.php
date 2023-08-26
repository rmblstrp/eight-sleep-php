<?php

namespace EightSleep\App\SleepMetrics\Objects;

use Carbon\Carbon;
use EightSleep\Framework\Domain\Objects\PersistableModelInterface;

interface SleepIntervalEntryInterface extends PersistableModelInterface
{
    function getUserId(): int;
    function setUserId(int $userId): SleepIntervalEntryInterface;

    function getIntervalId(): int;
    function setIntervalId(int $intervalId): SleepIntervalEntryInterface;

    function getIntervalDateTime(): Carbon;
    function setIntervalDateTime(Carbon $intervalDateTime): SleepIntervalEntryInterface;
}
