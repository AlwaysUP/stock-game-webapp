<?php

namespace App\Repository;

use App\Entity\Stat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stat[]    findAll()
 * @method Stat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stat::class);
    }

//    /**
//     * @return Stat[] Returns an array of Stat objects
//     */
    
    public function getTopStats()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }
    
    
    public function findById($id): ?Stat
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.userId = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Stat
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
