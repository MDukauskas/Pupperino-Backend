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
    private $url;

    /**
     * @var string
     */
    private $phone;

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
     * @var float
     */
    private $distance;

    /**
     * @var int
     */
    private $rating;

    /**
     * @var bool
     */
    private $isOpenNow;

    /**
     * @var array
     */
    private $openingHours;

    /**
     * @var string
     */
    private $website;

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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return VeterinaryClinic
     */
    public function setUrl(string $url): VeterinaryClinic
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return VeterinaryClinic
     */
    public function setPhone(?string $phone): VeterinaryClinic
    {
        $this->phone = $phone;
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
     * @return float
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     * @return VeterinaryClinic
     */
    public function setDistance(?float $distance): VeterinaryClinic
    {
        $this->distance = $distance;
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

    /**
     * @return array
     */
    public function getOpeningHours(): ?array
    {
        return $this->openingHours;
    }

    /**
     * @param array $openingHours
     * @return VeterinaryClinic
     */
    public function setOpeningHours(?array $openingHours): VeterinaryClinic
    {
        $this->openingHours = $openingHours;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return VeterinaryClinic
     */
    public function setWebsite(?string $website): VeterinaryClinic
    {
        $this->website = $website;
        return $this;
    }
}
