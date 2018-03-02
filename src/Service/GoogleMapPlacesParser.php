<?php

namespace App\Service;

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

    public function getVetsList(int $latitude, int $longitude): array
    {
        $places = [];

        try {
            $queryParams = [
                'location' => $latitude . ',' . $longitude,
                'radius' => self::RADIUS,
                'type' => self::TYPE_VETERINARY,
                'key' => self::API_KEY,
            ];

            $queryString = http_build_query($queryParams);

            $response = json_decode(
                file_get_contents(self::PLACES_BASE_URL . '?' . $queryString),
                true
            );

            if (isset($response['status']) && $response['status'] == 'OK' && !empty($response['results'])) {
                $places = $response['results'];
            }
        } catch (\Exception $e) {

        }

        return $places;
    }
}
