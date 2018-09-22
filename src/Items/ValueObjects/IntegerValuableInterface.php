<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 22/09/18
 * Time: 19:21
 */

namespace App\Items\ValueObjects;


interface IntegerValuableInterface
{
    public function value(): int;
}