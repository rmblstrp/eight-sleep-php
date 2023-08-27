<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class GetSleepIntervalController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return GetSleepInterval::class;
    }

    public function getDomainObjectClass(): ?string
    {
        return SleepIntervalRequest::class;
    }
}
