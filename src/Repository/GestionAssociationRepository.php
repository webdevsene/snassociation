<?php

namespace App\Repository;

use App\Entity\GestionAssociation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GestionAssociation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionAssociation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionAssociation[]    findAll()
 * @method GestionAssociation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionAssociationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionAssociation::class);
    }

    // /**
    //  * @return GestionAssociation[] Returns an array of GestionAssociation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GestionAssociation
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
