<?php
namespace App\Items;

use App\Items\ValueObjects\Quality;
use App\Items\ValueObjects\SellIn;

abstract class Item
{
    protected $quality;
    protected $sellIn;

    public function __construct(Quality $quality, SellIn $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function quality(): int
    {
        return $this->quality->value();
    }

    public function sellIn(): int
    {
        return $this->sellIn->value();
    }

    public function tick()
    {
        $this->sellIn->decrease();
        $this->updateQuality();
    }

    abstract protected function updateQuality();

}