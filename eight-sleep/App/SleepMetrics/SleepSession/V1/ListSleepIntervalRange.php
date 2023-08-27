<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

class ListSleepIntervalRange
{
    private string $from;
    private string $to;

    /**
     * @param string $from
     * @param string $to
     */
    public function __construct(string $from = '', string $to = '')
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }
}
