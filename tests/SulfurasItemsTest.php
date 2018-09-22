<?php
namespace Tests;

use App\GildedRose;
use App\Items\NormalItem;
use App\Items\SulfurasItem;
use App\Items\Types\SellableItem;
use App\Items\ValueObjects\LegendaryQuality;
use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class SulfurasItemsTest extends TestCase
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
        GildedRose::tickOf($this->item);
        Assert::assertEquals($prevQuality, $this->item->quality());
    }

    public function testItReturnsItemNotSellable()
    {
        Assert::assertNotInstanceOf(SellableItem::class, $this->item);
    }
}