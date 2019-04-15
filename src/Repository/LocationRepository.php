<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator, PDO;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Location::class);
    }

    // /**
    //  * @return Location[] Returns an array of Location objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Location
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	
	public function findLastKnownLocation(): array
	{
		$entityManager = $this->getEntityManager();
		
		$conn = $this->getEntityManager()->getConnection();

		$sql = '
			SELECT Latitude, Longitude
			FROM Location
			WHERE Latitude !=0.00 & Longitude !=0.00
			ORDER BY id DESC
			LIMIT 1
			';
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		// returns an array of arrays (i.e. a raw data set)
		return $stmt->fetchAll();
	
	}
	
}
