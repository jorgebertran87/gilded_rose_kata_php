<?php
namespace App\Items;

use App\Items\Types\SellableItem;
use App\Items\ValueObjects\Quality;

final class AgedBrieItem extends SellableItem
{
    protected function updateQuality()
    {
        if ($this->quality() === Quality::maximum()) {
            return;
        }

        $this->quality->increase();

        if ($this->sellIn() < 0 && $this->quality() < Quality::maximum()) {
            $this->quality->increase();
        }
    }
}