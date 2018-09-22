<?php

namespace App;

use App\Items\Types\TickableItem;

final class GildedRose
{
    // Dummy static method to practice DIP
    public static function tickOf(TickableItem $item)
    {
        $item->tick();
    }
}