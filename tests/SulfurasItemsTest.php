<?php

namespace Tests;

use App\Items\SulfurasItem;
use App\Items\Types\SellableItem;
use App\Items\ValueObjects\LegendaryQuality;
use PHPUnit\Framework\Assert;

final class SulfurasItemsTest extends GildedRoseTestCase
{
    /** @var SulfurasItem */
    private $item;

    public function setUp()
    {
        parent::setUp();
        $this->item = new SulfurasItem(new LegendaryQuality());
    }

    public function testItReturnsLegendaryQuality()
    {
        $prevQuality = $this->item->quality();
        Assert::assertEquals(80, $prevQuality);
        $this->tick($this->item);
        Assert::assertEquals($prevQuality, $this->item->quality());
    }

    public function testItReturnsItemNotSellable()
    {
        Assert::assertNotInstanceOf(SellableItem::class, $this->item);
    }
}