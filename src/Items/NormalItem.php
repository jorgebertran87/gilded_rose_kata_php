<?php
namespace App\Items;

use App\Items\Types\SellableItem;
use App\Items\ValueObjects\Quality;

final class NormalItem extends SellableItem
{
    protected function updateQuality()
    {
        if ($this->quality() === Quality::minimum()) {
            return;
        }

        $this->quality->decrease();

        if ($this->sellIn() <= 0) {
            $this->quality->decrease();
        }
    }
}