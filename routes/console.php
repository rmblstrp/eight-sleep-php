<?php

use EightSleep\App\SleepMetrics\SleepSession\V1\GetSleepInterval;
use EightSleep\App\SleepMetrics\SleepSession\V1\SleepIntervalRequest;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use EightSleep\Framework\Serialization\Json\Operation\SerializeObjectToJson;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sleep:interval', function (GetSleepInterval $getSleepInterval, SerializeObjectToJson $serializeObjectToJson) {
    $userId = 189;
    $intervalId = 1489046760;
    $sleepInterval = $getSleepInterval->execute(new SleepIntervalRequest($intervalId), (new DomainActionConfig())->setUserId($userId));
    $this->info($serializeObjectToJson->execute($sleepInterval));
})->purpose('Display an inspiring quote');
