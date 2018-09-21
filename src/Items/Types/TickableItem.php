<?php
namespace App\Items\Types;

abstract class TickableItem
{
    abstract public function tick();
}