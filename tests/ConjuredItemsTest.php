<?php
namespace Tests;

use App\GildedRose;
use App\Items\ConjuredItem;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class ConjuredItemsTest extends TestCase
{
    public function testItUpdatesConjuredItemsBeforeTheSellDate()
    {
        $item = new ConjuredItem(new Quality(10), new SellIn(10));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 8);
        Assert::assertEquals($item->sellIn(), 9);
    }

    public function testItUpdatesConjuredItemsBeforeTheSellDateWhenQualityIsZero()
    {
        $item = new ConjuredItem(new Quality(0), new SellIn(10));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), 9);
    }

    public function testItUpdatesConjuredItemOnSellDate()
    {
        $item = new ConjuredItem(new Quality(10), new SellIn(0));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 6);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesConjuredItemOnSellDateWhenQualityIsZero()
    {
        $item = new ConjuredItem(new Quality(0), new SellIn(0));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesConjuredItemAfterSellDate()
    {
        $item = new ConjuredItem(new Quality(10), new SellIn(-5));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 6);
        Assert::assertEquals($item->sellIn(), -6);
    }

    public function testItUpdatesConjuredItemAfterSellDateWhenQualityIsZero()
    {
        $item = new ConjuredItem(new Quality(0), new SellIn(-4));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -5);
    }
}