<?php

namespace App\Service;

use App\Entity\ProfileDog;

/**
 * Class DogService.
 */
class DogService
{
    /**
     * @param array $data
     *
     * @return ProfileDog
     */
    public function createDog(array $data): ProfileDog
    {
        return (new ProfileDog())
            ->setAge($data['age'] ?? null)
            ->setName($data['name'] ?? null)
            ->setBreed($data['breed'] ?? null)
            ->setCode($data['code'] ?? null)
            ->setHeight($data['height'] ?? null)
            ->setLength($data['length'] ?? null)
            ->setPicture($data['picture'] ?? null)
            ->setWeight($data['weight'] ?? null)
        ;
    }
}
