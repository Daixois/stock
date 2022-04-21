<?php

namespace App\Repository;

use App\Entity\Movie;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Scalar\MagicConst\Dir;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Movie::class);
        $this->paginator = $paginator;
    }
   

    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
  

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*
    * Récupérer les films
    *@return PaginationInterface
    */
    public function findSearchMovie(SearchData $search): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('m')
            ->select('m', 'g')
            ->join('m.genres', 'g');

        if (!empty($search->q)) {
            $query
                ->andWhere('m.title LIKE :q')
                ->setParameter('q', '%' . $search->q . '%');
        }
        
        if (!empty($search->anneeMin)) {
            $query
                ->andWhere('m.annee >= :q')
                ->setParameter('anneeMin', '%' . $search->anneeMin . '%');
        }
        if (!empty($search->anneeMax)) {
            $query
                ->andWhere('m.annee <= :q')
                ->setParameter('anneeMax', '%' . $search->anneeMax . '%');
        }

        if (!empty($search->genres)) {
            $query
                ->andWhere('g.id IN (:genres)')
                ->setParameter('genres', $search->genres);
        }
        $query =  $query->getQuery();
        return $this->paginator->paginate(
            $query,
            // $search->page,
            1,
            // $search->limit
            5
        );
    }
}
