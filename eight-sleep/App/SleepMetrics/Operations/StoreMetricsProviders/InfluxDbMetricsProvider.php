<?php

namespace EightSleep\App\SleepMetrics\Operations\StoreMetricsProviders;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Operations\StoreMetricsInterface;
use EightSleep\Framework\Domain\Operation\AbstractDomainOperation;

final class InfluxDbMetricsProvider extends AbstractDomainOperation implements StoreMetricsInterface
{
    function save(int $userId, Carbon $timestamp, string $measurement, string $value, array $attributes = [])
    {
        $this->logger->debug('InfluxDbMetricsProvider::save()', [
            'userId' => $userId,
            'timestamp' => $timestamp->toISOString(),
            'measurement' => $measurement,
            'value' => $value,
            'attributes' => $attributes,
        ]);
    }
}
