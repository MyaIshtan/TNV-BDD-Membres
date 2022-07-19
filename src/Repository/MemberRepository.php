<?php

namespace App\Repository;

use App\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Member>
 *
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    public function add(Member $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Member $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllAlphabetical(): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllFFT(): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.fftNumber != FALSE')
            //->setParameter('val', null)
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllActifFFT(): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.fftNumber != FALSE')
            ->andWhere('m.status = :val')
            ->setParameter('val', 1)
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllFirst(): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.secondClub = :val')
            ->setParameter('val', 1)
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllSecond(): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.secondClub = :val')
            ->setParameter('val', 2)
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllAg(): array
    {
        //TODO use the FFT rates to define who goes to ag
        return $this->createQueryBuilder('m')
            ->andWhere('m. = :val')
            ->setParameter('val', null)
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllYouths(): array
    {
        //TODO use -> peculiariy Ecole de Tir 
        //inner join on many to many
        return $this->createQueryBuilder('m')
            ->innerJoin('m.ratesFFT', 'r', 'WITH', )
            ->andWhere('m.ratesFFT = :val')
            ->setParameter('val', '1%')
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllInit(): array
    {
        //TODO use -> peculiariy Initiation adulte 
        //inner join on many to many
        return $this->createQueryBuilder('m')
            ->innerJoin('m.ratesFFT', 'r', 'WITH', )
            ->andWhere('m.ratesFFT = :val')
            ->setParameter('val', '1%')
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @return Member[] Returns an array of Member objects
     */
    public function findAllFFTA(): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.fftaNumber != FALSE')
            //->setParameter('val', null)
            ->orderBy('m.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }

//    /**
//     * @return Member[] Returns an array of Member objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Member
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
