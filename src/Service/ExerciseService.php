<?php

namespace App\Service;

use App\Entity\Exercise;
use App\Entity\ProfileDog;

/**
 * Class ExerciseService.
 */
class ExerciseService
{
    /**
     * @param array      $data
     * @param ProfileDog $dog
     *
     * @return $this|Exercise
     */
    public function createExercise(array $data, ProfileDog $dog)
    {
        return (new Exercise())
            ->setStartTime($data['startTime'] ? (new \DateTime())->setTimestamp(strtotime($data['startTime'])) : null)
            ->setEndTime($data['endTime'] ? (new \DateTime())->setTimestamp(strtotime($data['endTime'])) : null)
            ->setDuration($data['duration'] ? (int)$data['duration'] : null)
            ->setDistance($data['distance'] ? (float)$data['distance'] : null)
            ->setPath($data['path'] ? json_encode($data['path']) : null)
            ->setDog($dog)
        ;
    }
}
