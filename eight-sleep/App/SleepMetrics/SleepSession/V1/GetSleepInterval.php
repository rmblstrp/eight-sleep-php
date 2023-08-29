<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\App\SleepMetrics\Objects\SleepIntervalEntryInterface;
use EightSleep\App\SleepMetrics\Operations\GetSleepIntervalEntryInterface;
use EightSleep\App\SleepMetrics\Operations\GetSleepIntervalFromMetrics;
use EightSleep\App\SleepMetrics\Operations\ReadMetricsInterface;
use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\App\User\Operations\UserAccountsAreLinked;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class GetSleepInterval extends AbstractDomainAction
{
    private UserAccountsAreLinked $userAccountsAreLinked;
    private GetSleepIntervalEntryInterface $getSleepIntervalEntry;
    private ReadMetricsInterface $readMetrics;

    public function __construct(
        LoggerInterface $logger,
        UserAccountsAreLinked $userAccountsAreLinked,
        GetSleepIntervalEntryInterface $getSleepIntervalEntry,
        ReadMetricsInterface $readMetrics
    )
    {
        parent::__construct($logger);

        $this->userAccountsAreLinked = $userAccountsAreLinked;
        $this->getSleepIntervalEntry = $getSleepIntervalEntry;
        $this->readMetrics = $readMetrics;
    }

    protected function handle(SleepIntervalRequest $sleepIntervalRequest, DomainActionConfig $config): ?object
    {
        $targetUserId =$config->getUserId();

        if (!empty($sleepIntervalRequest->getLinkedUserId())) {
            if ($this->userAccountsAreLinked->isTrue($config->getUserId(), $sleepIntervalRequest->getLinkedUserId())) {
                $targetUserId = $sleepIntervalRequest->getLinkedUserId();
            }
            else {
                throw new \Exception('Users are not linked');
            }
        }

        $sleepIntervalEntry = $this->getSleepIntervalEntry->byIntervalId($sleepIntervalRequest->getId(), $targetUserId);
        if ($sleepIntervalEntry instanceof SleepIntervalEntryInterface) {
            $sleepInterval = $this->readMetrics->getByIntervalId($sleepIntervalRequest->getId(), $sleepIntervalEntry->getIntervalDateTime());
            $this->logger->debug(var_export($sleepInterval, true));
            return $sleepInterval;
        }

        return null;
    }
}
