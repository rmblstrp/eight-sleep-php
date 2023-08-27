<?php

namespace EightSleep\App\SleepMetrics\Operations\MetricProviders;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepMetric;
use EightSleep\App\SleepMetrics\Operations\ReadMetricsInterface;
use EightSleep\App\SleepMetrics\Operations\StoreMetricsInterface;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepInterval;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use InfluxDB2\Client as InfluxClient;
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

    public function getByIntervalId(int $intervalId): ?SleepInterval
    {
        $queryApi = $this->influxClient->createQueryApi();
        $query = [
            'from(bucket: "sleep_metrics")',
            '|> filter(fn: (r) => r.id == "'.$intervalId.'")',
        ];
        $result = $queryApi->queryRaw(implode(' ', $query));

        $this->logger->debug(var_export($result, true));
        return null;
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
