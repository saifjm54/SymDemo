<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Person>
 *
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    public function save(Person $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Person $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Person[] Returns an array of Person objects
//     */
    public function findPersonnesByAgeInterval($ageMin,$ageMax)
   {
        $qb = $this->createQueryBuilder('p');
        $this->addIntervalAge($qb,$ageMin,$ageMax);
        return $qb->getQuery()->getResult();
    }
    public function statsPersonnesByAgeInterval($ageMin,$ageMax)
    {
        $qb = $this->createQueryBuilder('p')
        ->select('avg(p.age) as ageMoyen , count(p.id) as nombrePersonne');
        $this->addIntervalAge($qb,$ageMin,$ageMax);
        return $qb->getQuery()->getScalarResult();
    }


    private function addIntervalAge(QueryBuilder $qb,$ageMin,$ageMax){
        $qb->andWhere('p.age >= :ageMin and p.age <= :ageMax')
        ->setParameters(['ageMin'=>$ageMin,'ageMax'=>$ageMax]);
    }

//    public function findOneBySomeField($value): ?Person
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
