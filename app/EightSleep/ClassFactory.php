<?php

declare(strict_types=1);

namespace App\EightSleep;

use Illuminate\Contracts\Foundation\Application;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use EightSleep\Framework\Domain\ClassFactoryInterface;
use Psr\Log\LoggerInterface;

class ClassFactory extends AbstractDomainOperation implements ClassFactoryInterface
{
    protected Application $application;

    public function __construct(LoggerInterface $logger, Application $application)
    {
        parent::__construct($logger);
        $this->application = $application;
    }

    public function make(string $class, array $parameters = [])
    {
        return $this->application->make($class, $parameters);
    }
}
