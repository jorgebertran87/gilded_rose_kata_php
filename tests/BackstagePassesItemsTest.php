<?php

namespace Tests;

use App\Items\BackstagePassesItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;

final class BackstagePassesItemsTest extends GildedRoseTestCase
{
    public function testItUpdatesBackstageItemsLongBeforeSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(11));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 11);
        Assert::assertEquals($item->sellIn(), 10);
    }

    public function testItUpdatesBackstageItemsCloseSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(9));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 12);
        Assert::assertEquals($item->sellIn(), 8);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(4));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 13);
        Assert::assertEquals($item->sellIn(), 3);
    }

    public function testItUpdatesBackstageItemsOnSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(0));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesBackstageItemsAfterSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(-4));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -5);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDateNearMaximumQuality()
    {
        $item = new BackstagePassesItem(new Quality(48), new SellIn(3));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 2);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDateVeryNearMaximumQuality()
    {
        $item = new BackstagePassesItem(new Quality(49), new SellIn(3));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 2);
    }

    public function testItUpdatesBackstageItemsCloseSellDateVeryNearMaximumQuality()
    {
        $item = new BackstagePassesItem(new Quality(49), new SellIn(10));
        $this->tick($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 9);
    }
}