<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Exercise.
 */
class Exercise
{
    private $exercises;

    /**
     * @Serializer\Type("array<'App/Entity/Exercise'>")
     *
     * @return array
     */
    public function getExercises(): array
    {
        return $this->exercises;
    }

    /**
     * @param array $exercises
     *
     * @return $this
     */
    public function setExercises($exercises = array()): self
    {
        $this->exercises = $exercises;

        return $this;
    }
}
