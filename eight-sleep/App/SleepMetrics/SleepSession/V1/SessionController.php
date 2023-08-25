<?php

namespace EightSleep\App\SleepMetrics\SleepSession\V1;

use EightSleep\Framework\Http\Controller\AbstractDomainActionController;

final class SessionController  extends AbstractDomainActionController
{

    public function getDomainActionClass(): string
    {
        return SessionAction::class;
    }

    public function getDomainObjectClass(): string
    {
        return SessionData::class;
    }
}
