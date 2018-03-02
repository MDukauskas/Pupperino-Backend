<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileDogRepository")
 * @ORM\Table(name="profile_dog")
 */
class ProfileDog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $age;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $picture;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $breed;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $weight;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $height;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $length;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $code;

    /**
     * @return int
     */
    public function getId(): int
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return $this
     */
    public function setName(string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     *
     * @return $this
     */
    public function setAge(int $age = null): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     *
     * @return $this
     */
    public function setPicture(string $picture = null): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBreed(): ?string
    {
        return $this->breed;
    }

    /**
     * @param string|null $breed
     *
     * @return $this
     */
    public function setBreed(string $breed = null): self
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     *
     * @return $this
     */
    public function setWeight(int $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     *
     * @return $this
     */
    public function setHeight(int $height = null): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     *
     * @return $this
     */
    public function setLength(int $length = null): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
