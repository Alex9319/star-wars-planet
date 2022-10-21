<?php

namespace App\Repository;

use App\Entity\Planets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Planets>
 *
 * @method Planets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planets[]    findAll()
 * @method Planets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planets::class);
    }

    /**
    * @return Planets[] Returns an array of Planets objects
    */
    public function findByIdPlanet($idPlanet)
    {

        $connection = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT 
                p.id, 
                p.name, 
                p.rotation_period,
                p.orbital_period,
                p.diameter,
                p.films_count as films,
                p.created,
                p.edited,
                p.url
            FROM planets as p
            WHERE p.id = :idPlanet ';

        $parameters['idPlanet'] = $idPlanet;

        $stmt = $connection->prepare($sql);

        $response = $stmt->executeQuery($parameters);

        return $response->fetchAllAssociative();
    }
}
