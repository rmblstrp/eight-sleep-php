<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use EightSleep\App\SleepMetrics\SleepSession\V1\IngestSessionData;
use EightSleep\App\SleepMetrics\SleepSession\V1\SessionData;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use EightSleep\Framework\Serialization\Json\Operation\GetObjectFromJson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use InfluxDB2\Client;
use InfluxDB2\Model\DeletePredicateRequest;
use InfluxDB2\Service\DeleteService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::delete('delete from sleep_interval_entry');
        DB::delete('delete from users');
        /** @var Client $influx */
        $influx = app()->make(Client::class);
        $service = $influx->createService(DeleteService::class);

        $predicate = new DeletePredicateRequest();
        $predicate->setStart(Carbon::create(2017, 1, 1));
        $predicate->setStop(Carbon::create(2018, 1, 1));
        $service->postDelete($predicate, null, 'eight_sleep', 'sleep_metrics');

        $seeds = [
            [
                'user' => User::factory()->make(['email' => 'user1@eightsleep.com']),
                'file' => 'f9bf229fd19e4c799e8c19a962d73449.json'
            ],
            [
                'user' => User::factory()->make(['email' => 'user2@eightsleep.com']),
                'file' => 'd6c1355e38194139b8d0c870baf86365.json'
            ],
            [
                'user' => User::factory()->make(['email' => 'user3@eightsleep.com']),
                'file' => '2228b530e055401f81ba37b51ff6f81d.json'
            ],
        ];

        foreach ($seeds as $item) {
            $item['user']->save();

            $json = file_get_contents(__DIR__.'/'.$item['file']);
            /** @var GetObjectFromJson $getObjectFromJson */
            $getObjectFromJson = app()->make(GetObjectFromJson::class);
            /** @var SessionData $session */
            $session = $getObjectFromJson->execute(SessionData::class, $json);

            /** @var IngestSessionData $sessionAction */
            $sessionAction = app()->make(IngestSessionData::class);
            $sessionAction->execute($session, (new DomainActionConfig())->setUserId($item['user']->id));
        }
    }
}
