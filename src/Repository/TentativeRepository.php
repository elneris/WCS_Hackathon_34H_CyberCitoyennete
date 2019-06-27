<?php

namespace App\Repository;

use App\Entity\Tentative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tentative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tentative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tentative[]    findAll()
 * @method Tentative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TentativeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tentative::class);
    }

    // /**
    //  * @return Tentative[] Returns an array of Tentative objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tentative
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
