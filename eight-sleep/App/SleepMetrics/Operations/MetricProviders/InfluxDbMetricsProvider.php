<?php

namespace EightSleep\App\SleepMetrics\Operations\MetricProviders;

use Carbon\Carbon;
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

    public function save(string $id, Carbon $timestamp, string $measurement, $value, array $attributes = []): void
    {
        $this->logger->debug('InfluxDbMetricsProvider::save()', [
            'id' => $id,
            'timestamp' => $timestamp->toISOString(),
            'measurement' => $measurement,
            'value' => $value,
            'attributes' => $attributes,
        ]);

        $attributes['value'] = $value;
        $point = new Point($measurement, ['id' => $id], $attributes, $timestamp);

        $writeApi = $this->influxClient->createWriteApi();
        $writeApi->write($point);
        $writeApi->close();
    }
}
