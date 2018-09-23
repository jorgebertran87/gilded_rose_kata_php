<?php

namespace Tests;

use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;

final class NormalItemsTest extends GildedRoseTestCase
{
    public function testItUpdatesNormalItemsBeforeSellDate()
    {
        $item = new NormalItem(new Quality(10), new SellIn(5));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 9);
        Assert::assertEquals($item->sellIn(), 4);
    }

    public function testItUpdatesNormalItemsOnSellDate()
    {
        $item = new NormalItem(new Quality(10), new SellIn(0));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 8);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesNormalItemsAfterTheSellDate()
    {
        $item = new NormalItem(new Quality(10), new SellIn(-4));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 8);
        Assert::assertEquals($item->sellIn(), -5);
    }

    public function testItUpdatesNormalItemsIfQualityIsZero()
    {
        $item = new NormalItem(new Quality(0), new SellIn(-4));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -5);
    }
}