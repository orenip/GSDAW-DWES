<?php

namespace App\Repository;

use App\Entity\EQUIPOS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EQUIPOS>
 *
 * @method EQUIPOS|null find($id, $lockMode = null, $lockVersion = null)
 * @method EQUIPOS|null findOneBy(array $criteria, array $orderBy = null)
 * @method EQUIPOS[]    findAll()
 * @method EQUIPOS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EQUIPOSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EQUIPOS::class);
    }

//    /**
//     * @return EQUIPOS[] Returns an array of EQUIPOS objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EQUIPOS
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
