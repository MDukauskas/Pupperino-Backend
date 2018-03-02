<?php

namespace App\Model;

/**
 * Class VeterinaryClinic
 * @package App\Model
 */
class VeterinaryClinic
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var double
     */
    private $latitude;

    /**
     * @var double
     */
    private $longitude;

    /**
     * @var int
     */
    private $rating;

    /**
     * @var bool
     */
    private $isOpenNow;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return VeterinaryClinic
     */
    public function setName(?string $name): VeterinaryClinic
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return VeterinaryClinic
     */
    public function setAddress(?string $address): VeterinaryClinic
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return VeterinaryClinic
     */
    public function setLatitude(?float $latitude): VeterinaryClinic
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return VeterinaryClinic
     */
    public function setLongitude(?float $longitude): VeterinaryClinic
    {
        $this->longitude = $longitude;
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
     * @return VeterinaryClinic
     */
    public function setRating(?int $rating): VeterinaryClinic
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOpenNow(): ?bool
    {
        return $this->isOpenNow;
    }

    /**
     * @param bool $isOpenNow
     * @return VeterinaryClinic
     */
    public function setIsOpenNow(?bool $isOpenNow): VeterinaryClinic
    {
        $this->isOpenNow = $isOpenNow;
        return $this;
    }
}
