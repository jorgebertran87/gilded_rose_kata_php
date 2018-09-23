<?php
namespace App\Items;

use App\Items\Types\SellableItem;

final class NormalItem extends SellableItem
{
    public function updateQuality()
    {
        $this->quality->decrease();

        if ($this->sellIn() <= 0) {
            $this->quality->decrease();
        }
    }
}