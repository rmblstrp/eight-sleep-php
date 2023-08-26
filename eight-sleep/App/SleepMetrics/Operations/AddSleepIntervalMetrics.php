<?php

namespace EightSleep\App\SleepMetrics\Operations;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Psr\Log\LoggerInterface;

class AddSleepIntervalMetrics extends AbstractDomainOperation
{
    private StoreMetricsInterface $storeMetrics;

    public function __construct(LoggerInterface $logger, StoreMetricsInterface $storeMetrics)
    {
        parent::__construct($logger);

        $this->storeMetrics = $storeMetrics;
    }

    public function add(SleepInterval $sleepInterval): void
    {
        $this->logger->debug('AddSleepIntervalMetrics::add', [
            'sleepInterval' => $sleepInterval,
        ]);

        $id = $sleepInterval->getId();
        $intervalTime = Carbon::createFromTimeString($sleepInterval->getTs());

        foreach ($sleepInterval->getStages() as $stage) {
            $this->storeMetrics->save($id, $intervalTime, 'stage', $stage->getStage(), [
                'duration' => $stage->getDuration(),
            ]);
        }

        $this->storeMetrics->save($id, $intervalTime, 'score', $sleepInterval->getScore());

        $timeSeries = $sleepInterval->getTimeseries();
        foreach ($timeSeries->getTnt() as $tnt) {
            $this->storeMetrics->save($id, Carbon::createFromTimeString($tnt[0]), 'tnt', $tnt[1]);
        }

        foreach ($timeSeries->getTempRoomC() as $tnt) {
            $this->storeMetrics->save($id, Carbon::createFromTimeString($tnt[0]), 'tempRoomC', $tnt[1]);
        }

        foreach ($timeSeries->getTempRoomC() as $tnt) {
            $this->storeMetrics->save($id, Carbon::createFromTimeString($tnt[0]), 'tempBedC', $tnt[1]);
        }

        foreach ($timeSeries->getRespiratoryRate() as $tnt) {
            $this->storeMetrics->save($id, Carbon::createFromTimeString($tnt[0]), 'respiratoryRate', $tnt[1]);
        }

        foreach ($timeSeries->getHeartRate() as $tnt) {
            $this->storeMetrics->save($id, Carbon::createFromTimeString($tnt[0]), 'heartRate', $tnt[1]);
        }

        foreach ($timeSeries->getHeating() as $tnt) {
            $this->storeMetrics->save($id, Carbon::createFromTimeString($tnt[0]), 'heating', $tnt[1]);
        }
    }
}
