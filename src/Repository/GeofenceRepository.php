<?php

namespace App\Repository;

use App\Entity\Geofence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Geofence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Geofence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Geofence[]    findAll()
 * @method Geofence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeofenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Geofence::class);
    }

    // /**
    //  * @return Geofence[] Returns an array of Geofence objects
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
    public function findOneBySomeField($value): ?Geofence
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
