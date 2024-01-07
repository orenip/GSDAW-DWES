<?php

namespace App\Repository;

use App\Entity\Zonas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Zonas>
 *
 * @method Zonas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zonas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zonas[]    findAll()
 * @method Zonas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZonasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zonas::class);
    }

//    /**
//     * @return Zonas[] Returns an array of Zonas objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('z.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Zonas
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
