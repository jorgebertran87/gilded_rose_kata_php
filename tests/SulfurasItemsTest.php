<?php
namespace Tests;

use App\GildedRose;
use App\Items\NormalItem;
use App\Items\SulfurasItem;
use App\Items\ValueObjects\LegendaryQuality;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class SulfurasItemsTest extends TestCase
{
    public function testItUpdatesSulfurasItemsBeforeSellDate()
    {
        $item = new SulfurasItem(new LegendaryQuality());

        $item->tick();

        Assert::assertEquals($item->quality(), 80);
    }
}