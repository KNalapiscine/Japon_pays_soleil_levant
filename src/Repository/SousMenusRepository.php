<?php

namespace App\Repository;

use App\Entity\SousMenus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SousMenus|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousMenus|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousMenus[]    findAll()
 * @method SousMenus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousMenusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SousMenus::class);
    }

    public function getSousMenus(){

        return $this->createQueryBuilder('s')
                ->select('s')
                ->leftJoin('s.menu', 'menus')
                ->addSelect('menus')
                ->getQuery()
                ->getResult();

    }

    // /**
    //  * @return SousMenus[] Returns an array of SousMenus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousMenus
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
