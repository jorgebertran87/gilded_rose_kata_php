<?php
namespace App\Items\Types;

use App\Items\ValueObjects\LegendaryQuality;

abstract class LegendaryItem extends TickableItem
{
    protected $quality;

    public function __construct(LegendaryQuality $quality)
    {
        $this->quality = $quality;
    }

    public function quality(): int
    {
        return $this->quality->value();
    }

    public function tick()
    {
        // we do nothing
    }
}