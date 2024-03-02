<?php

namespace App\Modules\User\Repository;

use App\Modules\User\Entity\PendingUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PendingUser>
 *
 * @method PendingUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PendingUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PendingUser[]    findAll()
 * @method PendingUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PendingUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PendingUser::class);
    }

    //    /**
    //     * @return PendingUser[] Returns an array of PendingUser objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PendingUser
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
