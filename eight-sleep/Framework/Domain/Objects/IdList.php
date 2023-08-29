<?php

namespace EightSleep\Framework\Domain\Objects;

class IdList
{
    /** @var int[]  */
    private array $ids = [];

    /**
     * @param int[] $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}
