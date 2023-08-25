<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use Carbon\Carbon;
use EightSleep\App\Authentication\Login\V1\Credentials;
use EightSleep\App\SleepMetrics\Operations\StoreMetricsInterface;
use EightSleep\Framework\Domain\Action\AbstractDomainAction;
use Psr\Log\LoggerInterface;

final class SessionAction extends AbstractDomainAction
{
    private StoreMetricsInterface $storeMetrics;

    public function __construct(LoggerInterface $logger, StoreMetricsInterface $storeMetrics)
    {
        parent::__construct($logger);

        $this->storeMetrics = $storeMetrics;
    }

    protected function handle(SessionData $sessionData): ?object
    {
        $userId = 0;

        foreach ($sessionData->getIntervals() as $interval) {
            $id = $interval->getId();
            $intervalTime = Carbon::createFromTimeString($interval->getTs());

            foreach ($interval->getStages() as $stage) {
                $this->storeMetrics->save($userId, $intervalTime, 'stage', $stage->getStage(), [
                    'id' => $id,
                    'duration' => $stage->getDuration(),
                ]);
            }

            $this->storeMetrics->save($userId, $intervalTime, 'score', $interval->getScore(), [
                'id' => $id,
            ]);

            $timeSeries = $interval->getTimeseries();
            foreach ($timeSeries->getTnt() as $tnt) {
                $this->storeMetrics->save($userId, Carbon::createFromTimeString($tnt[0]), 'tnt', $tnt[1], [
                    'id' => $id,
                ]);
            }

            foreach ($timeSeries->getTempRoomC() as $tnt) {
                $this->storeMetrics->save($userId, Carbon::createFromTimeString($tnt[0]), 'tempRoomC', $tnt[1], [
                    'id' => $id,
                ]);
            }

            foreach ($timeSeries->getTempRoomC() as $tnt) {
                $this->storeMetrics->save($userId, Carbon::createFromTimeString($tnt[0]), 'tempBedC', $tnt[1], [
                    'id' => $id,
                ]);
            }

            foreach ($timeSeries->getRespiratoryRate() as $tnt) {
                $this->storeMetrics->save($userId, Carbon::createFromTimeString($tnt[0]), 'respiratoryRate', $tnt[1], [
                    'id' => $id,
                ]);
            }

            foreach ($timeSeries->getHeartRate() as $tnt) {
                $this->storeMetrics->save($userId, Carbon::createFromTimeString($tnt[0]), 'heartRate', $tnt[1], [
                    'id' => $id,
                ]);
            }

            foreach ($timeSeries->getHeating() as $tnt) {
                $this->storeMetrics->save($userId, Carbon::createFromTimeString($tnt[0]), 'heating', $tnt[1], [
                    'id' => $id,
                ]);
            }
        }
        return null;
    }
}
