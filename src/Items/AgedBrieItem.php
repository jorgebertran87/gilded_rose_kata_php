<?php
namespace App\Items;

use App\Items\Types\SellableItem;

final class AgedBrieItem extends SellableItem
{
    protected function updateQuality()
    {
        $this->quality->increase();

        if ($this->sellIn() <= 0) {
            $this->quality->increase();
        }
    }
}