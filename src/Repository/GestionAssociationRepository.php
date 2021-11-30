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

    public function search($mots = null, $type = null)
    {
        #$query = $this->createQueryBuilder('g');
        $query = null ;
        if ($mots != null ) {
            $query = $this->createQueryBuilder('g')
                          ->andWhere('MATCH_AGAINST(g.denomination, g.numero_recipice, g.adresse_siege) AGAINST(:mots boolean)>0')
                          ->setParameter('mots', $mots);
        }
        // cette partie recherche par jointure sur le type de l'assaociation
        if($type != null){
            $query->leftJoin('g.types', 't')
                ->andWhere('t.id = :id')
                ->setParameter('id', $type);
        }

        return $query->orderBy('g.id', 'DESC')->getQuery()->getResult();
    }

    /**
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     *
     */
    public function countAllAssoc()
    {
        return $this->createQueryBuilder('ga')
                    ->select('COUNT(ga.id)')
                    ->getQuery()
                    ->getSingleScalarResult();
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
