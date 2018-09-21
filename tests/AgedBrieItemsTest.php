<?php
namespace Tests;

use App\GildedRose;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class AgedBrieItemsTest extends TestCase
{
    public function testItUpdatesBrieItemsBeforeSellDate()
    {
        $item = GildedRose::of('Aged Brie', 10, 5);

        $item->tick();

        Assert::assertEquals($item->quality, 11);
        Assert::assertEquals($item->sellIn, 4);
    }

    public function testItUpdatesBrieItemsBeforeSellDateWithMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 50, 5);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, 4);
    }

    public function testItUpdatesBrieItemsOnSellDate()
    {
        $item = GildedRose::of('Aged Brie', 8, 0);

        $item->tick();

        Assert::assertEquals($item->quality, 10);
        Assert::assertEquals($item->sellIn, -1);
    }

    public function testItUpdatesBrieItemsOnSellDateNearMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 49, 0);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, -1);
    }

    public function testItUpdatesBrieItemsOnSellDateWithMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 50, 0);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, -1);
    }

    public function testItUpdatesBrieItemsAfterSellDate()
    {
        $item = GildedRose::of('Aged Brie', 8, -4);

        $item->tick();

        Assert::assertEquals($item->quality, 10);
        Assert::assertEquals($item->sellIn, -5);
    }

    public function testItUpdatesBrieItemsAfterSellDateWithMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 50, -4);

        $item->tick();

        Assert::assertEquals($item->quality, 50);
        Assert::assertEquals($item->sellIn, -5);
    }
}