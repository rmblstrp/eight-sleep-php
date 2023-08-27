<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\App\SleepMetrics\Operations\ReadMetricsInterface;
use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use EightSleep\App\User\Operations\GetLinkedUserAccountsInterface;
use EightSleep\Framework\Domain\Actions\AbstractDomainAction;
use EightSleep\Framework\Domain\Objects\DomainActionConfig;
use Psr\Log\LoggerInterface;

class GetSleepInterval extends AbstractDomainAction
{
    private GetLinkedUserAccountsInterface $getLinkedUserAccounts;
    private ReadMetricsInterface $readMetrics;

    public function __construct(
        LoggerInterface $logger,
        GetLinkedUserAccountsInterface $getLinkedUserAccounts,
        ReadMetricsInterface $readMetrics
    )
    {
        parent::__construct($logger);

        $this->getLinkedUserAccounts = $getLinkedUserAccounts;
        $this->readMetrics = $readMetrics;
    }

    protected function handle(SleepIntervalRequest $sleepIntervalRequest, DomainActionConfig $config): ?object
    {
        $targetUserId = $config->getUserId();

        if (!empty($sleepIntervalRequest->getLinkedUserId())) {
            $linkedUserAccounts = $this->getLinkedUserAccounts->getForLinkedUsers($config->getUserId(), $sleepIntervalRequest->getLinkedUserId());
            if ($linkedUserAccounts instanceof LinkedUserAccountsInterface) {
                $targetUserId = $sleepIntervalRequest->getLinkedUserId();
            }
        }


    }
}
