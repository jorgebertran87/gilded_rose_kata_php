<?php
namespace Tests;

use App\GildedRose;
use App\Items\AgedBrieItem;
use App\Items\BackstagePassesItem;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class BackstagePassesItemsTest extends TestCase
{
    public function testItUpdatesBackstageItemsLongBeforeSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(11));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 11);
        Assert::assertEquals($item->sellIn(), 10);
    }

    public function testItUpdatesBackstageItemsCloseSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(9));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 12);
        Assert::assertEquals($item->sellIn(), 8);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(4));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 13);
        Assert::assertEquals($item->sellIn(), 3);
    }

    public function testItUpdatesBackstageItemsOnSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(0));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesBackstageItemsAfterSellDate()
    {
        $item = new BackstagePassesItem(new Quality(10), new SellIn(-4));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -5);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDateNearMaximumQuality()
    {
        $item = new BackstagePassesItem(new Quality(48), new SellIn(3));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 2);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDateVeryNearMaximumQuality()
    {
        $item = new BackstagePassesItem(new Quality(49), new SellIn(3));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 2);
    }

    public function testItUpdatesBackstageItemsCloseSellDateVeryNearMaximumQuality()
    {
        $item = new BackstagePassesItem(new Quality(49), new SellIn(10));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 9);
    }
}