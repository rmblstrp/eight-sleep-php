<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

final class IngestSessionDataController  extends AbstractDomainActionController
{
    public function getDomainActionClass(): string
    {
        return IngestSessionData::class;
    }

    public function getDomainObjectClass(): string
    {
        return SessionData::class;
    }
}
