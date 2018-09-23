<?php

namespace Tests;

use App\GildedRose;
use App\Items\Types\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTestCase extends TestCase
{
    protected function tick(Item $item)
    {
        $app = GildedRose::of($item);
        $app->tick();
    }
}