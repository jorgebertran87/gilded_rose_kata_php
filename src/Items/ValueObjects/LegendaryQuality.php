<?php
namespace App\Items\ValueObjects;

final class LegendaryQuality implements IntegerValuableInterface
{
    private $value = 80;

    public function value(): int
    {
        return $this->value;
    }
}