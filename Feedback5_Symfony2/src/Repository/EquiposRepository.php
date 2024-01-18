<?php

namespace App\Repository;

use App\Entity\Equipos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Equipos>
 *
 * @method Equipos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipos[]    findAll()
 * @method Equipos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquiposRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipos::class);
    }

//    /**
//     * @return Equipos[] Returns an array of Equipos objects
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

//    public function findOneBySomeField($value): ?Equipos
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
