<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use JMS\Serializer\Annotation as Serializer;

final class SleepInterval
{
    protected string $id = '';
    protected string $ts = '';
    /**
     * @var SleepStage[]
     * @Serializer\Type("array<EightSleep\App\SleepMetrics\SleepSession\V1\SleepStage>")
     */
    protected array $stages = [];
    protected int $score = 0;
    /**
     * @Serializer\Type("EightSleep\App\SleepMetrics\SleepSession\V1\SleepTimeSeries")
     */
    protected ?SleepTimeSeries $timeseries = null;

    public function __construct(string $id = '', string $ts = '', array $stages = [], int $score = 0, SleepTimeSeries $timeseries = null)
    {
        $this->id = $id;
        $this->ts = $ts;
        $this->stages = $stages;
        $this->score = $score;
        $this->timeseries = $timeseries;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTs(): string
    {
        return $this->ts;
    }

    /**
     * @return array|SleepStage[]
     */
    public function getStages(): array
    {
        return $this->stages;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getTimeseries(): SleepTimeSeries
    {
        return $this->timeseries;
    }
}
