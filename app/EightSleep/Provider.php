<?php

namespace App\EightSleep;

use Illuminate\Support\ServiceProvider;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use EightSleep\Framework\Domain\ClassFactoryInterface;

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
            return SerializerBuilder::create()->build();
        });
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
