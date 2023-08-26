<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use JMS\Serializer\Annotation as Serializer;

final class SleepTimeSeries
{
    /**
     * @Serializer\Type("array")
     */
    private array $tnt = [];
    /**
     * @Serializer\Type("array")
     */
    private array $tempRoomC = [];
    /**
     * @Serializer\Type("array")
     */
    private array $tempBedC = [];
    /**
     * @Serializer\Type("array")
     */
    private array $respiratoryRate = [];
    /**
     * @Serializer\Type("array")
     */
    private array $heartRate = [];
    /**
     * @Serializer\Type("array")
     */
    private array $heating = [];

    public function __construct(array $tnt = [], array $tempRoomC = [], array $tempBedC = [], array $respiratoryRate = [], array $heartRate = [], array $heating = [])
    {
        $this->tnt = $tnt;
        $this->tempRoomC = $tempRoomC;
        $this->tempBedC = $tempBedC;
        $this->respiratoryRate = $respiratoryRate;
        $this->heartRate = $heartRate;
        $this->heating = $heating;
    }

    public function getTnt(): array
    {
        return $this->tnt;
    }

    public function getTempRoomC(): array
    {
        return $this->tempRoomC;
    }

    public function getTempBedC(): array
    {
        return $this->tempBedC;
    }

    public function getRespiratoryRate(): array
    {
        return $this->respiratoryRate;
    }

    public function getHeartRate(): array
    {
        return $this->heartRate;
    }

    public function getHeating(): array
    {
        return $this->heating;
    }
}
