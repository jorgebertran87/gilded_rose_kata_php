<?php
namespace Tests;

use App\GildedRose;
use App\Items\AgedBrieItem;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class BackstagePassesItemsTest extends TestCase
{
    public function testItUpdatesBackstageItemsLongBeforeSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 11);

        $item->tick();

        Assert::assertEquals($item->quality, 11);
        Assert::assertEquals($item->sellIn, 10);
    }

    public function testItUpdatesBackstageItemsCloseSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 9);

        $item->tick();

        Assert::assertEquals($item->quality, 12);
        Assert::assertEquals($item->sellIn, 8);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 4);

        $item->tick();

        Assert::assertEquals($item->quality, 13);
        Assert::assertEquals($item->sellIn, 3);
    }

    public function testItUpdatesBackstageItemsOnSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 0);

        $item->tick();

        Assert::assertEquals($item->quality, 0);
        Assert::assertEquals($item->sellIn, -1);
    }

    public function testItUpdatesBackstageItemsAfterSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, -4);

        $item->tick();

        Assert::assertEquals($item->quality, 0);
        Assert::assertEquals($item->sellIn, -5);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDateNearMaximumQuality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 48, 3);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, 2);
    }

    public function testItUpdatesBackstageItemsVeryCloseSellDateVeryNearMaximumQuality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 49, 3);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, 2);
    }

    public function testItUpdatesBackstageItemsCloseSellDateVeryNearMaximumQuality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 49, 10);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, 9);
    }
}