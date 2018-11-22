<?php

namespace Beapp\Geocoder\Core\Transport;

use Beapp\Geocoder\Core\GeocodeResult;

interface GeocoderTransport
{

    /**
     * @param string $address
     * @return array|GeocodeResult[]
     */
    public function geocodeAddress(string $address): array;

    /**
     * @param float $latitude
     * @param float $longitude
     * @return array|GeocodeResult[]
     */
    public function geocodeCoordinates(float $latitude, float $longitude): array;

}
