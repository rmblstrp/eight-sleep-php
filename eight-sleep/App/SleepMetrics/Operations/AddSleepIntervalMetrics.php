<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepMetric;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class AddSleepIntervalMetrics extends AbstractDomainOperation
{
    private StoreMetricsInterface $storeMetrics;

    public function __construct(LoggerInterface $logger, StoreMetricsInterface $readMetrics)
    {
        parent::__construct($logger);

        $this->storeMetrics = $readMetrics;
    }

    public function add(SleepInterval $sleepInterval): void
    {
        $this->logger->debug(var_export($sleepInterval, true));

        $id = intval($sleepInterval->getId());
        $intervalTime = Carbon::createFromTimeString($sleepInterval->getTs());

        foreach ($sleepInterval->getStages() as $stage) {
            $metric = new SleepMetric($id, $intervalTime, 'stage', $stage->getStage(), [
                'duration' => $stage->getDuration(),
            ]);
            $this->storeMetrics->save($metric);
        }

        $metric = new SleepMetric($id, $intervalTime, 'stage', $sleepInterval->getScore());
        $this->storeMetrics->save($metric);

        $timeSeries = $sleepInterval->getTimeseries();
        foreach ($timeSeries->getTnt() as $tnt) {
            $metric = new SleepMetric($id, Carbon::createFromTimeString($tnt[0]), 'tnt', $tnt[1]);
            $this->storeMetrics->save($metric);
        }

        foreach ($timeSeries->getTempRoomC() as $tempRoomC) {
            $metric = new SleepMetric($id, Carbon::createFromTimeString($tempRoomC[0]), 'tempRoomC', $tempRoomC[1]);
            $this->storeMetrics->save($metric);
        }

        foreach ($timeSeries->getTempBedC() as $tempBedC) {
            $metric = new SleepMetric($id, Carbon::createFromTimeString($tempBedC[0]), 'tempBedC', $tempBedC[1]);
            $this->storeMetrics->save($metric);
        }

        foreach ($timeSeries->getRespiratoryRate() as $respiratoryRate) {
            $metric = new SleepMetric($id, Carbon::createFromTimeString($respiratoryRate[0]), 'respiratoryRate', $respiratoryRate[1]);
            $this->storeMetrics->save($metric);
        }

        foreach ($timeSeries->getHeartRate() as $heartRate) {
            $metric = new SleepMetric($id, Carbon::createFromTimeString($heartRate[0]), 'heartRate', $heartRate[1]);
            $this->storeMetrics->save($metric);
        }

        foreach ($timeSeries->getHeating() as $heating) {
            $metric = new SleepMetric($id, Carbon::createFromTimeString($heating[0]), 'heating', $heating[1]);
            $this->storeMetrics->save($metric);
        }
    }
}
