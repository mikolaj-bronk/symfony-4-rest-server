<?php

namespace App\Repository\Items\ItemsConditions;

use App\Repository\Items\{
    Interfaces\ItemsStrategyInterface,
    ItemsAbstract
};
use Doctrine\ORM\EntityRepository;

class EqualTo extends ItemsAbstract implements ItemsStrategyInterface
{
    public function getItems(int $value): array
    {
        return $this->repo->createQueryBuilder('i')
            ->andWhere('i.amount = 0')
            ->getQuery()
            ->getResult();
    }
}