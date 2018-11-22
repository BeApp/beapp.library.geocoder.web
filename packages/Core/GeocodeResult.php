<?php

namespace Beapp\Geocoder\Core;

class GeocodeResult
{
    /** @var string */
    private $address;
    /** @var float */
    private $latitude;
    /** @var float */
    private $longitude;

    /**
     * GeocodeResult constructor.
     * @param string $address
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(string $address, float $latitude, float $longitude)
    {
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

}
