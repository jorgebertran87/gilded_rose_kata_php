<?php
namespace Tests;

use App\GildedRose;
use App\Items\AgedBrieItem;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class AgedBrieItemsTest extends TestCase
{
    public function testItUpdatesBrieItemsBeforeSellDate()
    {
        $item = new AgedBrieItem(new Quality(10), new SellIn(5));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 11);
        Assert::assertEquals($item->sellIn(), 4);
    }

    public function testItUpdatesBrieItemsBeforeSellDateWithMaximumQuality()
    {
        $item = new AgedBrieItem(new Quality(50), new SellIn(5));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), 4);
    }

    public function testItUpdatesBrieItemsOnSellDate()
    {
        $item = new AgedBrieItem(new Quality(8), new SellIn(0));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 10);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesBrieItemsOnSellDateNearMaximumQuality()
    {
        $item = new AgedBrieItem(new Quality(49), new SellIn(0));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesBrieItemsOnSellDateWithMaximumQuality()
    {
        $item = new AgedBrieItem(new Quality(50), new SellIn(0));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesBrieItemsAfterSellDate()
    {
        $item = new AgedBrieItem(new Quality(8), new SellIn(-4));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 10);
        Assert::assertEquals($item->sellIn(), -5);
    }

    public function testItUpdatesBrieItemsAfterSellDateWithMaximumQuality()
    {
        $item = new AgedBrieItem(new Quality(50), new SellIn(-4));
        GildedRose::tickOf($item);

        Assert::assertEquals($item->quality(), 50);
        Assert::assertEquals($item->sellIn(), -5);
    }
}