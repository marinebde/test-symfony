<?php

namespace App\Repository;

use App\Entity\Mission;
use App\Data\SearchData;
use App\Form\SearchForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    findAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mission::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Mission $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Mission $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Récupère les missions en lien avec une recherche
     * @return Mission[]
     
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('m')
            ->select('s', 'm')
            ->join('m.speciality', 's');

            if(!empty($search->q)) {
                $query = $query
                    ->andWhere('m.title LIKE :q')
                    ->setParameter('q', "%{$search->q}%");
            }

            if(!empty($search->countries)) {
                $query = $query
                    ->andWhere('m.id IN (:countries)')
                    ->setParameter('countries', $search->countries);
            }

            if(!empty($search->specialites)) {
                $query = $query
                    ->andWhere('s.id IN (:specialites)')
                    ->setParameter('specialites', $search->specialites);
            }


        return $query->getQuery()->getResult();
    }*/

    /**
     * Récupère les nationalités de l'agent 
     */


    // /**
    //  * @return Mission[] Returns an array of Mission objects
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
    */

    /*
    public function findOneBySomeField($value): ?Mission
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
