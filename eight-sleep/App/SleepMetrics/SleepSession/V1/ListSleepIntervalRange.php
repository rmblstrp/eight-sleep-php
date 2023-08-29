<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

class ListSleepIntervalRange
{
    private string $from = '';
    private string $to = '';
    private ?int $linkedUserId = null;

    public function __construct(string $from = '', string $to = '', ?int $linkedUserId = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->linkedUserId = $linkedUserId;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getLinkedUserId(): ?int
    {
        return $this->linkedUserId;
    }
}
