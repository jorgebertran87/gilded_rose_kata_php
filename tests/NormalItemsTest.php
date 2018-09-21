<?php
namespace Tests;

use App\GildedRose;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class NormalItemsTest extends TestCase
{
    public function testItUpdatesNormalItemsBeforeSellDate()
    {
        $item = GildedRose::of('normal', 10, 5);

        $item->tick();

        Assert::assertEquals($item->quality, 9);
        Assert::assertEquals($item->sellIn, 4);
    }

    public function testItUpdatesNormalItemsOnSellDate()
    {
        $item = GildedRose::of('normal', 10, 0);

        $item->tick();

        Assert::assertEquals($item->quality, 8);
        Assert::assertEquals($item->sellIn, -1);
    }

    public function testItUpdatesNormalItemsAfterTheSellDate()
    {
        $item = GildedRose::of('normal', 10, -4);

        $item->tick();

        Assert::assertEquals($item->quality, 8);
        Assert::assertEquals($item->sellIn, -5);
    }

    public function testItUpdatesNormalItemsIfQualityIsZero()
    {
        $item = GildedRose::of('normal', 0, -4);

        $item->tick();

        Assert::assertEquals($item->quality, 0);
        Assert::assertEquals($item->sellIn, -5);
    }
}