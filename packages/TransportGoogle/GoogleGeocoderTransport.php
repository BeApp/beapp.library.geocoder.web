<?php

namespace Beapp\Geocoder\Transport\Google;

use Beapp\Geocoder\Core\GeocodeResult;
use Beapp\Geocoder\Core\GeocoderException;
use Beapp\Geocoder\Core\Transport\GeocoderTransport;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class GoogleGeocoderTransport implements GeocoderTransport
{

    /** @var string */
    private $apiKey;
    /** @var ClientInterface|null */
    private $httpClient;

    public function __construct(string $apiKey, ?ClientInterface $httpClient = null)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }

    public function getClient(): ClientInterface
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new Client([
                'base_uri' => 'https://maps.googleapis.com',
                'connect_timeout' => 5,
                'read_timeout' => 10
            ]);
        }
        return $this->httpClient;
    }

    /**
     * @param string $address
     * @return GeocodeResult[]
     * @throws GeocoderException
     */
    public function geocodeAddress(string $address): array
    {
        return $this->geocode([
            'address' => $address
        ]);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return GeocodeResult[]
     * @throws GeocoderException
     */
    public function geocodeCoordinates(float $latitude, float $longitude): array
    {
        return $this->geocode([
            'latlng' => $latitude . ',' . $longitude
        ]);
    }

    /**
     * @param array $query
     * @return GeocodeResult[]
     * @throws GeocoderException
     */
    private function geocode(array $query): array
    {
        try {
            $response = $this->httpClient->request('GET', '/maps/api/geocode/json', [
                'query' => array_merge([
                    'key' => $this->apiKey,
                ], $query)
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $status = $data['status'];

            if ($status == 'OK') {
                return array_map(function ($result) {
                    $location = $result['geometry']['location'];
                    return new GeocodeResult($result['formatted_address'], $location['lat'], $location['lng']);
                }, $data['results']);
            }

            throw new GeocoderException($status, 0);
        } catch (GuzzleException $e) {
            throw new GeocoderException('', 0, $e);
        }
    }
}
