<?php

namespace App\Repository\Items;

use App\Repository\ItemsRepository;

abstract class ItemsAbstract
{
    protected $repo;

    public function __construct(ItemsRepository $repo)
    {
        $this->repo = $repo;
    }
}