<?php
namespace App\Items;

use App\Items\ValueObjects\LegendaryQuality;
use App\Items\ValueObjects\Quality;

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