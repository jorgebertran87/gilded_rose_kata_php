<?php
namespace App\Items\Types;

use App\Items\ValueObjects\LegendaryQuality;
use App\Items\ValueObjects\Quality;

abstract class Item
{
    /** @var  Quality|LegendaryQuality */
    protected $quality;

    public function quality(): int
    {
        return $this->quality->value();
    }

    abstract public function tick();
}