<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

class ListSleepIntervalsController extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return ListSleepIntervals::class;
    }

    public function getDomainObjectClass(): ?string
    {
        return ListSleepIntervalRange::class;
    }
}
