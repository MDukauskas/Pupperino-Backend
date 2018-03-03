<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseRepository")
 */
class Exercise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $path;

    /**
     * @var ProfileDog
     *
     * @ORM\ManyToOne(targetEntity="ProfileDog")
     * @ORM\JoinColumn(name="dog_id", referencedColumnName="id")
     */
    private $dog;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartTime(): ?\DateTime
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime|null $startTime
     *
     * @return $this
     */
    public function setStartTime(\DateTime $startTime = null): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    /**
     * @param \DateTime|null $endTime
     *
     * @return $this
     */
    public function setEndTime(\DateTime $endTime = null): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     *
     * @return $this
     */
    public function setDuration(int $duration = null): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }

    /**
     * @param float|null $distance
     *
     * @return $this
     */
    public function setDistance(float $distance = null): self
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     *
     * @return $this
     */
    public function setPath(string $path = null): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return ProfileDog|null
     */
    public function getDog(): ?ProfileDog
    {
        return $this->dog;
    }

    /**
     * @param ProfileDog|null $dog
     *
     * @return $this
     */
    public function setDog(ProfileDog $dog = null): self
    {
        $this->dog = $dog;

        return $this;
    }
}
