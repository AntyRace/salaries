<?php

namespace App\ValueObjects;

class Price
{
    /**
     * Price value
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Get price value
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function getFormatted()
    {
        return number_format($this->value / 100, 2, '.', '');
    }

    /**
     * String price value
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
