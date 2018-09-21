<?php
namespace App\Items\ValueObjects;

final class Quality
{
    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function increase()
    {
        ++$this->value;
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