<?php
namespace App\Items;

abstract class TickableItem
{
    abstract public function tick();
}