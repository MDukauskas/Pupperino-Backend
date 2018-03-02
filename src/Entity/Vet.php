<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VetRepository")
 * @ORM\Table(name="vets")
 */
class Vet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $picture;

    /**
     * @var int
     *
     * @ORM\Column(type="int", nullable=true)
     */
    private $rating;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $latitude;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $workingHours;

    /**
     * @var float
     */
    private $distance;

    /**
     * @var bool
     */
    private $isAvailable;
}
