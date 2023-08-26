<?php

namespace EightSleep\Framework\Domain\Objects;

interface PersistableModelInterface
{
    function persist(): void;
}
