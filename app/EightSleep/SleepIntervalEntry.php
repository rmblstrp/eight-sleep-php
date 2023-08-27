<?php

namespace App\EightSleep;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepIntervalEntryInterface;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class SleepIntervalEntry extends Model implements SleepIntervalEntryInterface
{
    use HasTimestamps;

    protected $table = 'sleep_interval_entry';

    function getUserId(): int
    {
        return $this->getAttributeValue('user_id');
    }

    public function setUserId(int $userId): SleepIntervalEntryInterface
    {
        return $this->setAttribute('user_id', $userId);
    }

    public function getIntervalId(): int
    {
        return $this->getAttribute('interval_id');
    }

    public function setIntervalId(int $intervalId): SleepIntervalEntryInterface
    {
        return $this->setAttribute('interval_id', $intervalId);
    }

    public function getIntervalDateTime(): Carbon
    {
        return Carbon::createFromTimeString($this->getAttribute('interval_datetime'));
    }

    public function setIntervalDateTime(Carbon $intervalDateTime): SleepIntervalEntryInterface
    {
        return $this->setAttribute('interval_datetime', $intervalDateTime);
    }

    public function persist(): void
    {
        $this->save();
    }
}
