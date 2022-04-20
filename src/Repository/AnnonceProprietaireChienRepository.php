<?php

namespace App\Repository;

use App\Entity\AnnonceProprietaireChien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnnonceProprietaireChien|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnonceProprietaireChien|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnonceProprietaireChien[]    findAll()
 * @method AnnonceProprietaireChien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceProprietaireChienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnonceProprietaireChien::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AnnonceProprietaireChien $entity, bool $flush = true): void
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
    public function remove(AnnonceProprietaireChien $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /*public function searchLost(string $q)
    {
        $entityManager=$this->getEntityManager();
        $query= $entityManager
           // ->createQuery("SELECT a from App\Entity\AnnonceProprietaireChien a join a.idchien c join c.idindividu i where a.type='P' AND c.nom like :query
             //AND a.localisation like :query")
           ->createQuery("SELECT a from App\Entity\AnnonceProprietaireChien where a.type='P' AND a.localisation like :query")
            ->setParameter('query', '%' . $q. '%');
        return $query->getResult();
    } */
    public function searchLost(string $q)
    {
    $qb = $this->createQueryBuilder('a');



    $qb->innerJoin('App\Entity\Chien', 'c', 'WITH', 'c.idchien = a.idchien');

    $qb->innerJoin('App\Entity\Individu', 'i', 'WITH', 'i.idindividu = c.idindividu')



    ->where(

    $qb->expr()->andX(
    $qb->expr()->orX(

    $qb->expr()->like('a.localisation', ':query'),
    $qb->expr()->like('c.nom', ':query'),
    $qb->expr()->like('i.prenom', ':query')
)

)
)

        ->setParameter('query', '%' . $q . '%');
        $qb->andWhere( 'a.type = \'P\'');



return $qb->getQuery()->getResult();
}
   /* public function searchMating(string $q)
    {
        $entityManager=$this->getEntityManager();
        $query= $entityManager
           // ->createQuery("SELECT a from App\Entity\AnnonceProprietaireChien a join a.idchien c join c.idindividu i where c.nom like :query
   // AND a.localisation like :query")
           ->createQuery("SELECT a from App\Entity\AnnonceProprietaireChien a  where a.type='P' AND a.localisation like :query")
            ->setParameter('query', '%' . $q. '%');
        return $query->getResult();
    }*/
    public function searchMating(string $q)
    {
        $qb = $this->createQueryBuilder('a');


        $qb->innerJoin('App\Entity\Chien', 'c', 'WITH', 'c.idchien = a.idchien');
        $qb->innerJoin('App\Entity\Individu', 'i', 'WITH', 'i.idindividu = c.idindividu')


            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(

                        $qb->expr()->like('a.localisation', ':query'),
                        $qb->expr()->like('c.nom', ':query'),
                        $qb->expr()->like('i.prenom', ':query')
                    )

                )
            )

        ->setParameter('query', '%' . $q . '%');
        $qb->andWhere( 'a.type = \'A\'');
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return AnnonceProprietaireChien[] Returns an array of AnnonceProprietaireChien objects
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
    public function findOneBySomeField($value): ?AnnonceProprietaireChien
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
