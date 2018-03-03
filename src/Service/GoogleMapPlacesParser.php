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
    private const BASE_URL = 'https://maps.googleapis.com/maps/api/';
    private const PLACE_SEARCH_URL = 'place/nearbysearch/json';
    private const PLACE_DETAILS_URL = 'place/details/json';
    private const TYPE_VETERINARY = 'veterinary_care';
    private const RADIUS = '500000';

    /**
     * @param int $latitude
     * @param int $longitude
     * @return VeterinaryClinic[]|null
     */
    public function getVetsList(int $latitude, int $longitude): ?array
    {
        $queryParams = [
            'location' => $latitude . ',' . $longitude,
            'radius' => self::RADIUS,
            'type' => self::TYPE_VETERINARY,
        ];

        $places = $this->parseResults(self::PLACE_SEARCH_URL, $queryParams);
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

        $text = '';
        foreach ($results as $result) {
            $text .= $result['place_id'];
        }

        $placesIds = array_map(function ($result) {
            return $result['place_id'];
        }, $results);

        $queryParams = [
//            'placeid' => implode(',', $placesIds),
            'placeid' => $results[0]['place_id'],
        ];

        $test = $this->parseResults(self::PLACE_DETAILS_URL, $queryParams);

        return $list;
    }

    /**
     * @param string $url
     * @param array $queryParams
     * @return array
     */
    private function parseResults(string $url, array $queryParams): array
    {
        $results = [];

        $queryParams['key'] = self::API_KEY;
        $queryString = http_build_query($queryParams);

        $response = json_decode(
            file_get_contents(self::BASE_URL . $url . '?' . $queryString),
            true
        );

        if (isset($response['status']) && $response['status'] == 'OK' && !empty($response['results'])) {
            $results = $response['results'];
        }

        return $results;
    }
}
