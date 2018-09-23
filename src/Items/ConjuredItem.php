<?php

namespace App\Items;

use App\Items\Types\SellableItem;

final class ConjuredItem extends SellableItem
{
    private $normalItem;

    public function __construct(NormalItem $normalItem)
    {
        $this->normalItem = $normalItem;
        parent::__construct($normalItem->quality, $normalItem->sellIn);
    }
    protected function updateQuality()
    {
        $this->degradeQualityTwiceAsNormal();
    }

    private function degradeQualityTwiceAsNormal()
    {
        $this->normalItem->updateQuality();
        $this->normalItem->updateQuality();
    }
}