<?php

namespace App\Repository;

use App\Entity\Items;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Items|null find($id, $lockMode = null, $lockVersion = null)
 * @method Items|null findOneBy(array $criteria, array $orderBy = null)
 * @method Items[]    findAll()
 * @method Items[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Items::class);
    }

//    /**
//     * @return Items[] Returns an array of Items objects
//     */

    public function findItemsWhereAmountIsGreaterThanZero()
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.amount > 0')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findItemsWhereAmountIsEqualToZero()
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.amount = 0')
            ->getQuery()
            ->getResult()
            ;
    }


    public function findOneById($value): ?Items
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
