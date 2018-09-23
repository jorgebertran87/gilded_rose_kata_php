<?php

namespace Tests;

use App\Items\ConjuredItem;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;

final class ConjuredItemsTest extends GildedRoseTestCase
{
    public function testItUpdatesConjuredItemsBeforeTheSellDate()
    {
        $normalItem = new NormalItem(new Quality(10), new SellIn(10));
        $item = new ConjuredItem($normalItem);
        $this->tick($item);

        Assert::assertEquals($item->quality(), 8);
        Assert::assertEquals($item->sellIn(), 9);
    }

    public function testItUpdatesConjuredItemsBeforeTheSellDateWhenQualityIsZero()
    {
        $normalItem = new NormalItem(new Quality(0), new SellIn(10));
        $item = new ConjuredItem($normalItem);
        $this->tick($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), 9);
    }

    public function testItUpdatesConjuredItemOnSellDate()
    {
        $normalItem = new NormalItem(new Quality(10), new SellIn(0));
        $item = new ConjuredItem($normalItem);
        $this->tick($item);

        Assert::assertEquals($item->quality(), 6);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesConjuredItemOnSellDateWhenQualityIsZero()
    {
        $normalItem = new NormalItem(new Quality(0), new SellIn(0));
        $item = new ConjuredItem($normalItem);
        $this->tick($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesConjuredItemAfterSellDate()
    {
        $normalItem = new NormalItem(new Quality(10), new SellIn(-5));
        $item = new ConjuredItem($normalItem);
        $this->tick($item);

        Assert::assertEquals($item->quality(), 6);
        Assert::assertEquals($item->sellIn(), -6);
    }

    public function testItUpdatesConjuredItemAfterSellDateWhenQualityIsZero()
    {
        $normalItem = new NormalItem(new Quality(0), new SellIn(-4));
        $item = new ConjuredItem($normalItem);
        $this->tick($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -5);
    }
}