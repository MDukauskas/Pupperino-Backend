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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="id")
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $openTime;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $closeTime;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAvailable;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $institution;

    /**
     * @var bool
     */
    private $open;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this|null
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this|null
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     *
     * @return $this|null
     */
    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return int
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     *
     * @return $this|null
     */
    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    /**
     * @param bool $isAvailable
     *
     * @return $this|null
     */
    public function setIsAvailable(?bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOpenTime(): ?string
    {
        return $this->openTime;
    }

    /**
     * @param string $openTime
     *
     * @return $this|null
     */
    public function setOpenTime(?string $openTime): self
    {
        $this->openTime = $openTime;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCloseTime(): ?string
    {
        return $this->closeTime;
    }

    /**
     * @param string $closeTime
     *
     * @return $this|null
     */
    public function setCloseTime(?string $closeTime): self
    {
        $this->closeTime = $closeTime;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    /**
     * @param string $institution
     *
     * @return $this|null
     */
    public function setInstitution(?string $institution): self
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * @param bool $status
     *
     * @return $this
     */
    public function setOpen(bool $status): self
    {
        $this->open = $status;

        return $this;
    }

    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        $openAt = str_replace(':', '', $this->getOpenTime());
        $closeAt = str_replace(':', '', $this->getCloseTime());
        $now = date('Hi');

        return (($openAt <= $now) && ($closeAt >= $now));
    }
}
