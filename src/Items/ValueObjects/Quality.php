<?php

namespace App\Items\ValueObjects;

final class Quality implements IntegerValuableInterface
{
    private static $MAXIMUM = 50;
    private static $MINIMUM = 0;

    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function increase(int $value=1)
    {
        $this->value += $value;

        if ($this->value > self::$MAXIMUM) {
            $this->value = self::$MAXIMUM;
        }
    }

    public function decrease(int $value=1)
    {
        $this->value -= $value;

        if ($this->value < self::$MINIMUM) {
            $this->value = self::$MINIMUM;
        }
    }

    public function none()
    {
        $this->value = 0;
    }

    public function value(): int
    {
        return $this->value;
    }

    public static function maximum(): int
    {
        return self::$MAXIMUM;
    }

    public static function minimum(): int
    {
        return self::$MINIMUM;
    }
}