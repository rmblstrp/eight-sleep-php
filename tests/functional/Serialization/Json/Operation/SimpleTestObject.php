<?php

declare(strict_types=1);

namespace Tests\Functional\Serialization\Json\Operation;

class SimpleTestObject
{
    protected bool $testEnabled = false;

    /**
     * @return bool|null
     */
    public function getTestEnabled(): ?bool
    {
        return $this->testEnabled;
    }

    /**
     * @param bool|null $testEnabled
     * @return SimpleTestObject
     */
    public function setTestEnabled(?bool $testEnabled): SimpleTestObject
    {
        $this->testEnabled = $testEnabled;
        return $this;
    }
}