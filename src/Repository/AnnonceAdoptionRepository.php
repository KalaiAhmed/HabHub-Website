<?php

namespace App\Repository;

use App\Entity\AnnonceAdoption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnnonceAdoption|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnonceAdoption|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnonceAdoption[]    findAll()
 * @method AnnonceAdoption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceAdoptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnonceAdoption::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AnnonceAdoption $entity, bool $flush = true): void
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
    public function remove(AnnonceAdoption $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAnnonceByDogName(string $q)
    {
        $qb = $this->createQueryBuilder('a');

       $qb->innerJoin('App\Entity\Chien', 'c', 'WITH', 'c.idchien = a.idchien');
       $qb->innerJoin('App\Entity\Individu', 'i', 'WITH', 'i.idindividu = a.idindividu')

        ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('i.prenom', ':query'),
                        $qb->expr()->like('a.localisation', ':query'),
                        $qb->expr()->like('c.nom', ':query'),
                    )

                )
            )
            ->setParameter('query', '%' . $q . '%');
            $qb->andWhere( 'a.status = \'P\'');
        return $qb
            ->getQuery()
            ->getResult();
    }


   function findEntitiesByString(string $q)
    {
        $qb = $this->createQueryBuilder('u')

            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(

                        $qb->expr()->like('u.email', ':query')

                    )

                )
            );

            $qb->setParameter('query',$q . '%');

        return $qb->getQuery()->getResult();
    }

    public function getAnnonces($filters = null){
        $query = $this->createQueryBuilder('a')->
        Where( 'a.status = \'P\'');
        
        // On filtre les données
        if($filters != null){
            $query->andWhere('a.idindividu IN(:indiv)')
                ->setParameter(':indiv', array_values($filters));
        }

        $query->orderBy('a.datepublication');
        return $query->getQuery()->getResult();
    }


    // /**
    //  * @return AnnonceAdoption[] Returns an array of AnnonceAdoption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnnonceAdoption
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
