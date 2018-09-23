<?php

namespace App\Items\ValueObjects;

final class SellIn implements IntegerValuableInterface
{
    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function decrease()
    {
        --$this->value;
    }

    public function value(): int
    {
        return $this->value;
    }
}