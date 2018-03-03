<?php

namespace App\Service;

use App\Model\VeterinaryClinic;

/**
 * Class GoogleMapPlacesParser
 * @package App\Service
 */
class GoogleMapPlacesParser
{
    private const API_KEY = 'AIzaSyDNlSlxiH84IdJ076Br6m-A__mAb1Gb36o';
    private const PLACES_BASE_URL = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
    private const TYPE_VETERINARY = 'veterinary_care';
    private const RADIUS = '500000';

    /**
     * @param int $latitude
     * @param int $longitude
     * @return VeterinaryClinic[]|null
     * @throws \Exception
     */
    public function getVetsList(int $latitude, int $longitude): ?array
    {
        $queryParams = [
            'location' => $latitude . ',' . $longitude,
            'radius' => self::RADIUS,
            'type' => self::TYPE_VETERINARY,
            'key' => self::API_KEY,
        ];

        $places = $this->parseResults($queryParams);
        $places = $this->getFormattedResults($places);

        return $places;
    }

    /**
     * @param array $results
     * @return VeterinaryClinic[]|null
     */
    private function getFormattedResults(array $results): ?array
    {
        if (empty($results)) {
            return null;
        }

        $list = [];
        foreach ($results as $result) {
            $list[] = (new VeterinaryClinic())
                ->setName(isset($result['name']) ? $result['name'] : null)
                ->setAddress(isset($result['vicinity']) ? $result['vicinity'] : null)
                ->setLatitude(isset($result['geometry']['location']['lat']) ? $result['geometry']['location']['lat'] : null)
                ->setLongitude(isset($result['geometry']['location']['lng']) ? $result['geometry']['location']['lng'] : null)
                ->setRating(isset($result['rating']) ? $result['rating'] : null)
                ->setIsOpenNow(isset($result['opening_hours']['open_now']) ? $result['opening_hours']['open_now'] : null);
        }

        return $list;
    }

    /**
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function parseResults(array $queryParams): array
    {
        $results = [];

        $queryString = http_build_query($queryParams);

        $response = json_decode(
            file_get_contents(self::PLACES_BASE_URL . '?' . $queryString),
            true
        );

        if (isset($response['status']) && $response['status'] == 'OK' && !empty($response['results'])) {
            $results = $response['results'];
        }

        return $results;
    }
}
