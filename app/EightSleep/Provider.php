<?php

namespace App\EightSleep;

use EightSleep\App\SleepMetrics\Objects\SleepIntervalEntryInterface;
use EightSleep\App\SleepMetrics\Operations\GetSleepIntervalEntryInterface;
use EightSleep\App\SleepMetrics\Operations\MetricProviders\InfluxDbMetricsProvider;
use EightSleep\App\SleepMetrics\Operations\ReadMetricsInterface;
use EightSleep\App\SleepMetrics\Operations\StoreMetricsInterface;
use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetAccountLinkRequestEntryInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetUserInterface;
use EightSleep\Framework\Domain\ClassFactoryInterface;
use Illuminate\Support\ServiceProvider;
use InfluxDB2\Client as InfluxDbClient;
use InfluxDB2\Model\WritePrecision;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Provider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ClassFactoryInterface::class, ClassFactory::class);
        $this->app->bind(SerializerInterface::class, function () {
            return SerializerBuilder::create()
                ->setPropertyNamingStrategy(
                    new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(
                        new \JMS\Serializer\Naming\IdenticalPropertyNamingStrategy()
                    )
                )
                ->build();
        });
        $this->app->bind(StoreMetricsInterface::class, InfluxDbMetricsProvider::class);
        $this->app->bind(ReadMetricsInterface::class, InfluxDbMetricsProvider::class);
        $this->app->bind(SleepIntervalEntryInterface::class, SleepIntervalEntry::class);
        $this->app->bind(InfluxDbClient::class, function () {
            $config = config('database.influxdb');
            return new InfluxDbClient([
                'url' => $config['url'],
                'token' => $config['token'],
                'bucket' => $config['bucket'],
                'org' => $config['org'],
                'precision' => WritePrecision::NS
            ]);
        });
        $this->app->bind(GetUserInterface::class, GetUser::class);
        $this->app->bind(AccountLinkRequestEntryInterface::class, AccountLinkRequestEntry::class);
        $this->app->bind(GetAccountLinkRequestEntryInterface::class, GetAccountLinkRequestEntry::class);
        $this->app->bind(LinkedUserAccountsInterface::class, LinkedUserAccounts::class);
        $this->app->bind(GetSleepIntervalEntryInterface::class, GetSleepIntervalEntry::class);
        $this->app->bind(GetLinkedUserAccountsInterface::class, GetLinkedUserAccounts::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
