<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
    //  */
    public function findByNotPassed($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.end_date >= :val')
            ->setParameter('val', $value)
            ->orderBy('r.start_date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function checkIfIsAlreadyTaken($start, $end)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.end_date BETWEEN :start AND :end')
            ->andWhere('r.start_date BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }
}
