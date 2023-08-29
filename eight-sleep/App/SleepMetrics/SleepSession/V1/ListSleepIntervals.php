<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use Carbon\Carbon;
use EightSleep\App\SleepMetrics\Objects\SleepIntervalEntryInterface;
use EightSleep\App\SleepMetrics\Operations\GetSleepIntervalEntryInterface;
use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\App\User\Operations\UserAccountsAreLinked;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use EightSleep\Framework\Domain\Objects\IdList;
use Psr\Log\LoggerInterface;

class ListSleepIntervals extends AbstractDomainAction
{
    private UserAccountsAreLinked $userAccountsAreLinked;
    private GetSleepIntervalEntryInterface $getSleepIntervalEntry;

    public function __construct(
        LoggerInterface $logger,
        UserAccountsAreLinked $userAccountsAreLinked,
        GetSleepIntervalEntryInterface $getSleepIntervalEntry
    )
    {
        parent::__construct($logger);

        $this->userAccountsAreLinked = $userAccountsAreLinked;
        $this->getSleepIntervalEntry = $getSleepIntervalEntry;
    }

    protected function handle(ListSleepIntervalRange $listSleepIntervalRange, DomainActionConfig $config): ?object
    {
        $targetUserId = $config->getUserId();

        if (!empty($listSleepIntervalRange->getLinkedUserId())) {
            if ($this->userAccountsAreLinked->isTrue($config->getUserId(), $listSleepIntervalRange->getLinkedUserId())) {
                $targetUserId = $listSleepIntervalRange->getLinkedUserId();
            }
            else {
                throw new \Exception('Users are not linked');
            }
        }

        $intervals = $this->getSleepIntervalEntry->byDateRange(
            $targetUserId,
            Carbon::createFromTimeString($listSleepIntervalRange->getFrom()),
            Carbon::createFromTimeString($listSleepIntervalRange->getTo()));

        $intervalIds = [];
        foreach ($intervals as $interval) {
            $intervalIds[] = $interval->getIntervalId();
        }

        return new IdList($intervalIds);
    }
}
