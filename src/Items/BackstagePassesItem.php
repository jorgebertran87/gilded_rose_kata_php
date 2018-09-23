<?php

namespace App\Items;

use App\Items\Types\SellableItem;

final class BackstagePassesItem extends SellableItem
{
    protected function updateQuality()
    {
        if ($this->itIsFarFromSellDate()) {
            $this->quality->increase();
        }
        elseif($this->itIsCloseToSellDate()) {
            $this->quality->increase(2);
        }
        elseif($this->itIsVeryCloseToSellDate()) {
            $this->quality->increase(3);
        }
        elseif($this->itIsAfterSellDate()) {
            $this->quality->none();
        }
    }

    private function itIsFarFromSellDate(): bool
    {
        return $this->sellIn() >= 10;
    }

    private function itIsCloseToSellDate(): bool
    {
        return $this->sellIn() < 10 and $this->sellIn() >= 5;
    }

    private function itIsVeryCloseToSellDate(): bool
    {
        return $this->sellIn() < 5 and $this->sellIn() >= 0;
    }

    private function itIsAfterSellDate(): bool
    {
        return $this->sellIn() < 0;
    }
}