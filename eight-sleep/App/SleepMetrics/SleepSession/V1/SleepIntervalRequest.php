<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

class SleepIntervalRequest
{
    private int $id = -1;
    private ?int $linkedUserId = null;

    /**
     * @param int $id
     * @param int|null $linkedUserId
     */
    public function __construct(int $id = -1, ?int $linkedUserId = null)
    {
        $this->id = $id;
        $this->linkedUserId = $linkedUserId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLinkedUserId(): ?int
    {
        return $this->linkedUserId;
    }
}
