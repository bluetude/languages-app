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

    public function add(PendingUser $pendingUser): void
    {
        $em = $this->getEntityManager();

        $em->persist($pendingUser);
        $em->flush();
    }

    public function remove(PendingUser $pendingUser): void
    {
        $em = $this->getEntityManager();

        $em->remove($pendingUser);
        $em->flush();
    }
}
