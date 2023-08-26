<?php

declare(strict_types=1);

namespace App\EightSleep;

use EightSleep\Framework\Domain\ClassFactoryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use Illuminate\Contracts\Foundation\Application;
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
