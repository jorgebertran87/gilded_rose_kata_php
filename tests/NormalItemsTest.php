<?php
namespace Tests;

use App\GildedRose;
use App\Items\NormalItem;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class NormalItemsTest extends TestCase
{
    public function testItUpdatesNormalItemsBeforeSellDate()
    {
        $item = new NormalItem(new Quality(10), new SellIn(5));

        $item->tick();

        Assert::assertEquals($item->quality(), 9);
        Assert::assertEquals($item->sellIn(), 4);
    }

    public function testItUpdatesNormalItemsOnSellDate()
    {
        $item = new NormalItem(new Quality(10), new SellIn(0));

        $item->tick();

        Assert::assertEquals($item->quality(), 8);
        Assert::assertEquals($item->sellIn(), -1);
    }

    public function testItUpdatesNormalItemsAfterTheSellDate()
    {
        $item = new NormalItem(new Quality(10), new SellIn(-4));

        $item->tick();

        Assert::assertEquals($item->quality(), 8);
        Assert::assertEquals($item->sellIn(), -5);
    }

    public function testItUpdatesNormalItemsIfQualityIsZero()
    {
        $item = new NormalItem(new Quality(0), new SellIn(-4));

        $item->tick();

        Assert::assertEquals($item->quality(), 0);
        Assert::assertEquals($item->sellIn(), -5);
    }
}