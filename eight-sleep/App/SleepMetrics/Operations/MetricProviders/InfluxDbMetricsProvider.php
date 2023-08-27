<?php

namespace EightSleep\App\SleepMetrics\Operations\MetricProviders;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepMetric;
use EightSleep\App\SleepMetrics\Operations\ReadMetricsInterface;
use EightSleep\App\SleepMetrics\Operations\StoreMetricsInterface;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepStage;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepTimeSeries;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use InfluxDB2\Client as InfluxClient;
use InfluxDB2\Model\Query;
use InfluxDB2\Point;
use Psr\Log\LoggerInterface;

final class InfluxDbMetricsProvider extends AbstractDomainOperation implements StoreMetricsInterface, ReadMetricsInterface
{
    private InfluxClient $influxClient;

    public function __construct(LoggerInterface $logger, InfluxClient $influxClient)
    {
        parent::__construct($logger);

        $this->influxClient = $influxClient;
    }

    public function getByIntervalId(int $intervalId, Carbon $intervalDateTime): ?SleepInterval
    {
        $queryApi = $this->influxClient->createQueryApi();
        $queryCriteria = [
            'from(bucket: "sleep_metrics")',
            '|> range(start: '.$intervalDateTime->toISOString().')',
            '|> filter(fn: (r) => r.id == "'.$intervalId.'")',
        ];
        $parameterizedQuery = implode(' ', $queryCriteria);
        $this->logger->debug('InfluxDbMetricsProvider::getByIntervalId', ['query' => $parameterizedQuery]);
        $query = new Query();
        $query->setQuery($parameterizedQuery);
        $tables = $queryApi->query($query);

        $stages = [];
        $score = null;
        $tnt = [];
        $tempRoomC = [];
        $tempBedC = [];
        $respiratoryRate = [];
        $heartRate = [];
        $heating = [];

        foreach ($tables as $table) {
            foreach ($table->records as $record) {
                $this->logger->debug(var_export($record->values, true));

                switch ($record['_measurement']) {
                    case 'stage':
                        $stages[$record['index']] = new SleepStage($record['value'], $record['duration']);
                        break;
                    case 'score':
                        $score = intval($record['value']);
                        break;
                    case 'tnt':
                        $tnt[] = [$record['_time'], $record['value']];
                        break;
                    case 'tempRoomC':
                        $tempRoomC[] = [$record['_time'], $record['value']];
                        break;
                    case 'tempBedC':
                        $tempBedC[] = [$record['_time'], $record['value']];
                        break;
                    case 'respiratoryRate':
                        $respiratoryRate[] = [$record['_time'], $record['value']];
                        break;
                    case 'heartRate':
                        $heartRate[] = [$record['_time'], $record['value']];
                        break;
                    case 'heating':
                        $heating[] = [$record['_time'], $record['value']];
                        break;
                }
            }
        }

        ksort($stages);
        $sleepTimeSeries = new SleepTimeSeries($tnt, $tempRoomC, $tempBedC, $respiratoryRate, $heartRate, $heating);
        return new SleepInterval($intervalId, $intervalDateTime->toISOString(), array_values($stages), $score, $sleepTimeSeries);
    }

    public function save(SleepMetric $sleepMetric): void
    {
        $tags = [
            'id' => (string)$sleepMetric->getId(),
            'value' => (string)$sleepMetric->getValue(),
        ];

        foreach ($sleepMetric->getAdditional() as $name => $value) {
            $tags[$name] = (string)$value;
        }

        $this->logger->debug('InfluxDbMetricsProvider::save()', [
            'id' => $sleepMetric->getId(),
            'timestamp' => $sleepMetric->getDatetime(),
            'measurement' => $sleepMetric->getName(),
            'value' => $sleepMetric->getValue(),
            'additional' => $sleepMetric->getAdditional(),
            'tags' => $tags,
        ]);

        $point = new Point($sleepMetric->getName(), $tags, ['hack' => 1], $sleepMetric->getDatetime());
        $this->logger->debug('InfluxDbMetricsProvider::save()');
        //$this->logger->debug(var_export($point, true));

        $writeApi = $this->influxClient->createWriteApi();
        $writeApi->write($point);
        $writeApi->close();
    }
}
