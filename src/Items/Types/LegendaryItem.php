<?php
namespace App\Items\Types;

use App\Items\ValueObjects\LegendaryQuality;

abstract class LegendaryItem extends Item
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