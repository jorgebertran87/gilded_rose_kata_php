<?php
namespace App\Items\Types;

use App\Items\ValueObjects\LegendaryQuality;

abstract class LegendaryItem extends TickableItem
{
    public function __construct(LegendaryQuality $quality)
    {
        $this->quality = $quality;
    }

    public function tick()
    {
        // we do nothing
    }
}