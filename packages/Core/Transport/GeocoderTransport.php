<?php

namespace Beapp\Geocoder\Core\Transport;

use Beapp\Geocoder\Core\GeocodeResult;
use Beapp\Geocoder\Core\GeocoderException;

interface GeocoderTransport
{

    /**
     * @param string $address
     * @return GeocodeResult[]
     * @throws GeocoderException
     */
    public function geocodeAddress(string $address): array;

    /**
     * @param float $latitude
     * @param float $longitude
     * @return GeocodeResult[]
     * @throws GeocoderException
     */
    public function geocodeCoordinates(float $latitude, float $longitude): array;

}
