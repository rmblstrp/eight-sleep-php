<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

final class SessionData
{
    /**
     * @var SleepInterval[]
     * @Serializer\Type("array<EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval>")
     */
    private array $intervals = [];

    /**
     * @param SleepInterval[] $intervals
     */
    public function __construct(array $intervals = [])
    {
        $this->intervals = $intervals;
    }

    public function getIntervals(): array
    {
        return $this->intervals;
    }
}
