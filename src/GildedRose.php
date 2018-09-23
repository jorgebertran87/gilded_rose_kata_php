<?php

namespace App;

use App\Items\Types\Item;

final class GildedRose
{
    private $item;

    private function  __construct(Item $item)
    {
        $this->item = $item;
    }

    public function tick()
    {
        $this->item->tick();
    }

    public static function of(Item $item): self
    {
        return new self($item);
    }
}