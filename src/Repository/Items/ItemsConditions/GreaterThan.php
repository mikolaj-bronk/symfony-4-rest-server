<?php

namespace App\Repository\Items\ItemsConditions;

use App\Repository\Items\Interfaces\ItemsStrategyInterface;
use App\Repository\Items\ItemsAbstract;

class GreaterThan extends ItemsAbstract implements ItemsStrategyInterface
{
    public function getItems(int $value)
    {
        return $this->repo->createQueryBuilder('i')
            ->andWhere('i.amount > :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
