<?php

namespace App;

use App\Items\Types\Item;

final class GildedRose
{
    // Dummy static method to practice DIP
    public static function tickOf(Item $item)
    {
        $item->tick();
    }
}