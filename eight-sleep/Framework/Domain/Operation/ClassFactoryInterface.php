<?php

declare(strict_types=1);

namespace EightSleep\Framework\Domain\Operation;

interface ClassFactoryInterface
{

    /**
     * Resolve the given type from the container.
     *
     * @param string $class
     * @param array  $parameters
     *
     * @return mixed
     */
    public function make(string $class, array $parameters = []);
}
