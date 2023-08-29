<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

class SleepIntervalRequest
{
    private int $intervalId = -1;
    private ?int $linkedUserId = null;

    /**
     * @param int $intervalId
     * @param int|null $linkedUserId
     */
    public function __construct(int $intervalId = -1, ?int $linkedUserId = null)
    {
        $this->intervalId = $intervalId;
        $this->linkedUserId = $linkedUserId;
    }

    public function getIntervalId(): int
    {
        return $this->intervalId;
    }

    public function getLinkedUserId(): ?int
    {
        return $this->linkedUserId;
    }
}
