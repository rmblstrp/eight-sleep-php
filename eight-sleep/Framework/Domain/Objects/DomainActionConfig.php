<?php

namespace EightSleep\Framework\Domain\Objects;

class DomainActionConfig
{
    private int $userId;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): DomainActionConfig
    {
        $this->userId = $userId;
        return $this;
    }
}
