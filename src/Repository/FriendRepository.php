<?php

namespace App\Repository;

use App\Entity\Friend;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Friend>
 *
 * @method Friend|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friend|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friend[]    findAll()
 * @method Friend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Friend::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Friend $entity, bool $flush = true): void
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
    public function remove(Friend $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function demande($currentId)
    {
        $qb = $this->createQueryBuilder('f');
        $qb->select('f')
        ->where($qb->expr()->andX(
            $qb->expr()->eq('f.send', ':currentId')
        ))
        ->setParameters(new ArrayCollection([
            new Parameter('currentId', $currentId)
        ]));
        return $qb->getQuery()->getResult();
    }

    public function recu($currentId)
    {
        $qb = $this->createQueryBuilder('f');
        $qb->select('f')
        ->where($qb->expr()->andX(
            $qb->expr()->eq('f.receive', ':currentId')
        ))
        ->setParameters(new ArrayCollection([
            new Parameter('currentId', $currentId)
        ]));
        return $qb->getQuery()->getResult();
    }

    public function envoyerPar($currentId, $user)
    {
        $qb = $this->createQueryBuilder('f');
        $qb->select('f')
        ->where($qb->expr()->andX(
            $qb->expr()->eq('f.send', ':currentId'),
            $qb->expr()->eq('f.receive', ':user')
        ))
        ->orWhere($qb->expr()->andX(
            $qb->expr()->eq('f.receive', ':currentId'),
            $qb->expr()->eq('f.send', ':user')
        ))
        ->setParameters(new ArrayCollection([
            new Parameter('currentId', $currentId),
            new Parameter('user', $user)
        ]));
        return $qb->getQuery()->getResult();
    }

    public function all($currentId)
    {
        $qb = $this->createQueryBuilder('f');
        $qb->select('f')
        ->where($qb->expr()->andX(
            $qb->expr()->eq('f.statut', true),
        ))
        ->andWhere($qb->expr()->orX(
            $qb->expr()->eq('f.receive', ':currentId'),
            $qb->expr()->eq('f.send', ':currentId')
        ))
        ->setParameters(new ArrayCollection([
            new Parameter('currentId', $currentId),
        ]));
        return $qb->getQuery()->getResult();
    }
    // /**
    //  * @return Friend[] Returns an array of Friend objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Friend
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
