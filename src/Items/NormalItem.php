<?php
namespace App\Items;

final class NormalItem extends Item
{
    public function tick()
    {
        $this->sellIn->decrease();

        if ($this->quality() === 0) {
            return;
        }

        $this->quality->decrease();

        if ($this->sellIn() < 0) {
            $this->quality->decrease();
        }
    }
}