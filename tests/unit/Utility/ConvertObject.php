<?php

declare(strict_types=1);

namespace Tests\Unit\Utility;

use Traversable;

class ConvertObject implements \IteratorAggregate
{
    /** @var mixed */
    private $value;

    private $items = [1, 2, 3];

    /**
     * ConvertObject constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * @return \ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
