<?php

namespace App\Repository;

use App\Entity\Individu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Individu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Individu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Individu[]    findAll()
 * @method Individu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndividuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Individu::class);
    }

    public function getIndividu(int $id){
        $entityManager=$this->getEntityManager();
        $query= $entityManager
            ->createQuery("SELECT i FROM App\Entity\Individu i JOIN i.idutilisateur u where u.idutilisateur=:idutilisateur")
            ->setParameters(array('idutilisateur',$id));
        return $query->getResult();
    }

    public function FiltreIndividu(){
        $entityManager=$this->getEntityManager();
        $query= $entityManager
            ->createQuery("SELECT DISTINCT i.nom, i.idindividu FROM App\Entity\Individu i join   ");
        return $query->getResult();
    }

    public function findindiv()
    {
        $qb = $this->createQueryBuilder('i');

       $qb->innerJoin('App\Entity\AnnonceAdoption', 'a', 'WITH', 'a.idindividu = i.idindividu');
        return $qb
            ->getQuery()
            ->getResult();
    }



    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Individu $entity, bool $flush = true): void
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
    public function remove(Individu $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    /*
    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM AppBundle:Entity e
                WHERE e.foo LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }*/
    public function findEntitiesByString1(string $q)
    {
        $qb = $this->createQueryBuilder('p');


        $qb->innerJoin('App\Entity\Individu', 'c', 'WITH', 'c.idIndividu = p.idIndividu')



            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(

                        $qb->expr()->like('p.nom', ':query'),
                        $qb->expr()->like('c.nom', ':query')

                    )

                )
            )

            ->setParameter('query',$q . '%');

        return $qb->getQuery()->getResult();
    }


    public function getTotalProduits($filter = null){
        $query = $this->createQueryBuilder('p');


        // On filtre les données
        if($filter != null){
            $query->andWhere('p.idIndividu IN(:cats)')
                ->setParameter(':cats', array_values($filter));
        }

        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Individu[] Returns an array of Individu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Individu
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
