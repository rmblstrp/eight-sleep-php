<?php

declare(strict_types=1);

namespace Tests\Unit\Utility;

class ArrayObject
{
    public function toArray()
    {
        return ['just' => 'Expanding', 'possibilities' => '!!!'];
    }
}
