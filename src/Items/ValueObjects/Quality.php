<?php
namespace App\Items\ValueObjects;

final class Quality
{
    private static $MAXIMUM = 50;
    private static $MINIMUM = 0;

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

    public static function maximum(): int
    {
        return self::$MAXIMUM;
    }

    public static function minimum(): int
    {
        return self::$MINIMUM;
    }
}