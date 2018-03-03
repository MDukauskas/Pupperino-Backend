<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ExerciseRepository.
 */
class ExerciseRepository extends ServiceEntityRepository
{
    /**
     * ExerciseRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    /**
     * @param int $id Dog id.
     *
     * @return array
     */
    public function getExercises(int $id): array
    {
        $builder = $this->createQueryBuilder('e');

        $builder
            ->where($builder->expr()->eq('e.dog', $id))
            ->select('e.id, e.startTime, e.endTime, e.duration, e.distance, e.path')
            ->orderBy($builder->expr()->desc('e.id'));

        return $builder->getQuery()->getResult();
    }
}
