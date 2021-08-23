<?php

namespace App\Repository;

use App\Entity\TypeAssociation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeAssociation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAssociation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAssociation[]    findAll()
 * @method TypeAssociation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAssociationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAssociation::class);
    }

    // /**
    //  * @return TypeAssociation[] Returns an array of TypeAssociation objects
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
    public function findOneBySomeField($value): ?TypeAssociation
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