<?php

namespace App\Repository;

use App\Entity\ProfileDog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProfileDog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfileDog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfileDog[]    findAll()
 * @method ProfileDog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfileDogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProfileDog::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
