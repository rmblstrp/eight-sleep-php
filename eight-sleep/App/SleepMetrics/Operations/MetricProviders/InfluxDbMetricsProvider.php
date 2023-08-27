<?php

namespace EightSleep\App\SleepMetrics\Operations\MetricProviders;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepMetric;
use EightSleep\App\SleepMetrics\Operations\StoreMetricsInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use InfluxDB2\Client as InfluxClient;
use InfluxDB2\Point;
use Psr\Log\LoggerInterface;

final class InfluxDbMetricsProvider extends AbstractDomainOperation implements StoreMetricsInterface
{
    private InfluxClient $influxClient;

    public function __construct(LoggerInterface $logger, InfluxClient $influxClient)
    {
        parent::__construct($logger);

        $this->influxClient = $influxClient;
    }

    public function save(SleepMetric $sleepMetric): void
    {
        $additional = $sleepMetric->getAdditional();
        $additional['value'] = $sleepMetric->getValue();
        $point = new Point($sleepMetric->getName(), ['id' => (string)$sleepMetric->getId()], $additional, $sleepMetric->getDatetime());

        $writeApi = $this->influxClient->createWriteApi();
        $writeApi->write($point);
        $writeApi->close();
    }
}
