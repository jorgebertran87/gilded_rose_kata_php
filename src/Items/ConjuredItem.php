<?php
namespace App\Items;

final class ConjuredItem extends NormalItem
{
    protected function updateQuality()
    {
        $this->degradeQualityTwiceAsNormal();
    }

    private function degradeQualityTwiceAsNormal()
    {
        parent::updateQuality();
        parent::updateQuality();
    }
}