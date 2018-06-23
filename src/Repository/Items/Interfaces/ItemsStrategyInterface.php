<?php

namespace App\Repository\Items\Interfaces;

interface ItemsStrategyInterface
{
    public function getItems(int $value);
}
