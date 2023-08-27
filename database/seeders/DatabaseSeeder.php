<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use EightSleep\App\SleepMetrics\SleepSession\V1\IngestSessionData;
use EightSleep\App\SleepMetrics\SleepSession\V1\SessionData;
use EightSleep\App\User\LinkAccounts\V1\AccountLinkRequestEntry;
use EightSleep\App\User\LinkAccounts\V1\RequestAccountLinking;
use EightSleep\App\User\LinkAccounts\V1\CancelAccountLinking;
use EightSleep\App\User\LinkAccounts\V1\CompleteAccountLinking;
use EightSleep\App\User\LinkAccounts\V1\InitiateAccountLinking;
use EightSleep\App\User\Operations\LinkUserAccounts;
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
        DB::delete('delete from linked_user_accounts');
        DB::delete('delete from account_link_request_entry');
        DB::delete('delete from users');
        /** @var Client $influx */
        $influx = app()->make(Client::class);
        $service = $influx->createService(DeleteService::class);

        $predicate = new DeletePredicateRequest();
        $predicate->setStart(Carbon::create(2017, 1, 1));
        $predicate->setStop(Carbon::create(2018, 1, 1));
        $service->postDelete($predicate, null, 'eight_sleep', 'sleep_metrics');

        /** @var User $user1 */
        $user1 = User::factory()->make(['email' => 'user1@eightsleep.com']);
        $user1->save();

        /** @var User $user2 */
        $user2 = User::factory()->make(['email' => 'user2@eightsleep.com']);
        $user2->save();

        /** @var User $user3 */
        $user3 = User::factory()->make(['email' => 'user3@eightsleep.com']);
        $user3->save();

        /** @var User $user4 */
        $user4 = User::factory()->make(['email' => 'user4@eightsleep.com']);
        $user4->save();

        $seeds = [
            [
                'user' => $user1,
                'file' => 'f9bf229fd19e4c799e8c19a962d73449.json'
            ],
            [
                'user' => $user2,
                'file' => 'd6c1355e38194139b8d0c870baf86365.json'
            ],
            [
                'user' => $user3,
                'file' => '2228b530e055401f81ba37b51ff6f81d.json'
            ],
        ];

        $inviteEntryIds = [];

        /** @var InitiateAccountLinking $initiateAccountLinking */
        $initiateAccountLinking = app()->make(InitiateAccountLinking::class);
        /** @var CompleteAccountLinking $completeAccountLinking */
        $completeAccountLinking = app()->make(CompleteAccountLinking::class);
        /** @var CancelAccountLinking $cancelAccountLinking */
        $cancelAccountLinking = app()->make(CancelAccountLinking::class);
        /** @var LinkUserAccounts $linkUserAccounts */
        $linkUserAccounts = app()->make(LinkUserAccounts::class);

        foreach ($seeds as $item) {
            /** @var User $user */
            $user = $item['user'];
            $json = file_get_contents(__DIR__.'/'.$item['file']);
            /** @var GetObjectFromJson $getObjectFromJson */
            $getObjectFromJson = app()->make(GetObjectFromJson::class);
            /** @var SessionData $session */
            $session = $getObjectFromJson->execute(SessionData::class, $json);

            /** @var IngestSessionData $sessionAction */
            $sessionAction = app()->make(IngestSessionData::class);
            $sessionAction->execute($session, (new DomainActionConfig())->setUserId($user->getId()));

            $inviteEntryIds[$user->getId()] = $initiateAccountLinking->execute(new RequestAccountLinking($user->getEmail()), (new DomainActionConfig())->setUserId($user4->getId()));
        }

        // linked_user_accounts should have a row connecting user1@eightsleep.com with user2@eightsleep.com
        $linkUserAccounts->link($user1->getId(), $user2->getId());

        // linked_user_accounts should have a row connecting user2@eightsleep.com with user3@eightsleep.com
        $linkUserAccounts->link($user2->getId(), $user3->getId());

        // linked_user_accounts should have a row connecting user3@eightsleep.com with user1@eightsleep.com
        $linkUserAccounts->link($user3->getId(), $user1->getId());

        // Account link request entry for user1@eightsleep.com should have been removed from account_link_request_entry table
        // linked_user_accounts should have a row connecting user1@eightsleep.com with user4@eightsleep.com
        $completeAccountLinking->execute(new AccountLinkRequestEntry($inviteEntryIds[$user1->getId()]->getId()), (new DomainActionConfig())->setUserId($user1->getId()));

        // Account link request entry for user2@eightsleep.com should have been removed from account_link_request_entry table
        $cancelAccountLinking->execute(new AccountLinkRequestEntry($inviteEntryIds[$user2->getId()]->getId()), (new DomainActionConfig())->setUserId($user2->getId()));

        // Account link request entry for user3@eightsleep.com should remain in account_link_request_entry table
    }
}
