<?php

namespace App\Service;

use App\Model\VeterinaryClinic;

/**
 * Class GoogleMapPlacesParser
 * @package App\Service
 */
class GoogleMapPlacesParser
{
    private const API_KEY = 'AIzaSyDycc2ftZRn6eMC40qgUj98ESp0MlJxv7k';
    private const BASE_URL = 'https://maps.googleapis.com/maps/api/';
//    private const PLACE_SEARCH_URL = 'place/nearbysearch/json';
    private const PLACE_SEARCH_URL = 'place/textsearch/json';
    private const PLACE_DETAILS_URL = 'place/details/json';
    private const DISTACE_URL = 'distancematrix/json';
    private const TYPE_VETERINARY = 'veterinary_care';
    private const RADIUS = '50000';
    private const KEYWORD = 'veterinarijos';

    /**
     * @var DistanceCalculator
     */
    private $distanceCalculator;

    /**
     * GoogleMapPlacesParser constructor.
     * @param DistanceCalculator $distanceCalculator
     */
    public function __construct(DistanceCalculator $distanceCalculator)
    {
        $this->distanceCalculator = $distanceCalculator;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return array|null
     * @throws \Exception
     */
    public function getVetsClinicsList(float $latitude, float $longitude): ?array
    {
        $queryParams = [
            'location' => $latitude . ',' . $longitude,
            'radius' => self::RADIUS,
//            'type' => self::TYPE_VETERINARY,
//            'language' => 'lt',
            'query' => self::KEYWORD,
        ];

        $places = $this->parseResults(self::PLACE_SEARCH_URL, $queryParams);
        $places = $this->getFormattedResults($latitude, $longitude, $places);

        return $places;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param array $results
     * @return array|null
     * @throws \Exception
     */
    private function getFormattedResults(float $latitude, float $longitude, array $results): ?array
    {
        if (empty($results)) {
            return null;
        }

        $list = [];
        foreach ($results as $result) {
            $place = (new VeterinaryClinic())
                ->setName(isset($result['name']) ? $result['name'] : null)
                ->setAddress(isset($result['formatted_address']) ? $result['formatted_address'] : null)
                ->setLatitude(isset($result['geometry']['location']['lat']) ? $result['geometry']['location']['lat'] : null)
                ->setLongitude(isset($result['geometry']['location']['lng']) ? $result['geometry']['location']['lng'] : null)
                ->setDistance($this->calculateDistance($latitude, $longitude, $result))
                ->setRating(isset($result['rating']) ? $result['rating'] : null)
                ->setIsOpenNow(isset($result['opening_hours']['open_now']) ? $result['opening_hours']['open_now'] : null);

            $placeDetails = $this->getPlaceDetails($result);
            if (!empty($placeDetails)) {
                $place
                    ->setPhone(isset($placeDetails['international_phone_number']) ? $placeDetails['international_phone_number'] : null)
                    ->setWebsite(isset($placeDetails['website']) ? $placeDetails['website'] : null)
                    ->setOpeningHours(isset($result['opening_hours']) ? $result['opening_hours'] : null);
            }

//            $distance = $this->getDistanceDetails($latitude, $longitude, $result);
//            if (!empty($distance)) {
//                $place->setDistance($distance);
//            }

            $list[] = $place;
        }

        usort($list, $this->distanceCalculator->sortByKey('distance'));

        return $list;
    }

    /**
     * @param array $result
     * @return array
     * @throws \Exception
     */
    private function getPlaceDetails(array $result)
    {
        $queryParams = [
            'placeid' => $result['place_id'],
        ];

        return $this->parseResults(self::PLACE_DETAILS_URL, $queryParams);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param array $result
     * @return float
     */
    private function calculateDistance(float $latitude, float $longitude, array $result)
    {
        if (empty($result['geometry']['location'])) {
            return null;
        }

        $lat2 = $result['geometry']['location']['lat'];
        $lng2 = $result['geometry']['location']['lng'];
        $distance = $this->distanceCalculator->distance($latitude, $longitude, $lat2, $lng2);

        return number_format($distance, 2);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param array $result
     * @return float
     * @throws \Exception
     */
    private function getDistanceDetails(float $latitude, float $longitude, array $result)
    {
        if (empty($result)) {
            return null;
        }

        $lat2 = $result['geometry']['location']['lat'];
        $lng2 = $result['geometry']['location']['lng'];
        $queryParams = [
            'units' => 'metric',
            'origins' => $latitude . ',' . $longitude,
            'destinations' => $lat2 . ',' . $lng2,
        ];

        $distanceDetails = $this->parseResults(self::DISTACE_URL, $queryParams);

        if (empty($distanceDetails)) {
            return null;
        }

        return isset($distanceDetails[0]['elements']['distance']['value']) ? $distanceDetails[0]['elements']['distance']['value'] : null;
    }

    /**
     * @param string $url
     * @param array $queryParams
     * @return array
     * @throws \Exception
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

        if (isset($response['status']) && $response['status'] == 'OK') {
            if (!empty($response['results'])) {
                $results = $response['results'];
            }

            if (!empty($response['result'])) {
                $results = $response['result'];
            }

            if (!empty($response['rows'])) {
                $results = $response['rows'];
            }
        } elseif (isset($response['error_message'])) {
            throw new \Exception($response['error_message']);
        } elseif (isset($response['status'])) {
            throw new \Exception($response['status']);
        }

        return $results;
    }
}
