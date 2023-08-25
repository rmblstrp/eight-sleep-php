<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

final class SleepStage
{
    protected string $stage = '';
    protected int $duration = 0;

    public function __construct(string $stage = '', int $duration = 0)
    {
        $this->stage = $stage;
        $this->duration = $duration;
    }

    public function getStage(): string
    {
        return $this->stage;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}
