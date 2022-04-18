<?php

namespace App\Repository;

use App\Entity\CollectionGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionGenre[]    findAll()
 * @method CollectionGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionGenre::class);
    }

    // /**
    //  * @return CollectionGenre[] Returns an array of CollectionGenre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CollectionGenre
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
