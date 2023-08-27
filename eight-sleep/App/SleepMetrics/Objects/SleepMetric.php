<?php

namespace EightSleep\App\SleepMetrics\Objects;

use Carbon\Carbon;

class SleepMetric
{
    private int $id;
    private Carbon $datetime;
    private string $name;
    private mixed $value;
    private array $additional;

    /**
     * @param int $id
     * @param Carbon $datetime
     * @param string $name
     * @param string $value
     * @param array $additional
     */
    public function __construct(int $id, Carbon $datetime, string $name, mixed $value, array $additional = [])
    {
        $this->datetime = $datetime;
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->additional = $additional;
    }

    public function getDatetime(): Carbon
    {
        return $this->datetime;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getAdditional(): array
    {
        return $this->additional;
    }
}
