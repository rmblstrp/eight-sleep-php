<?php

namespace EightSleep\Framework\Domain\Objects;

interface DeletableModelInterface
{
    function delete(): void;
}
