<?php

namespace App\Service;

/**
 * Class DistanceCalculator
 * @package App\Service
 */
class DistanceCalculator
{
    /**
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @param string $unit
     * @return float
     */
    public function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    /**
     * @param string $key
     * @param string $order
     * @return \Closure
     */
    public function sortByKey($key, $order = 'ASC') {
        return function($a, $b) use ($key, $order) {
            // Swap order if necessary
            if ($order == 'DESC') {
                list($a, $b) = array($b, $a);
            }
            // Check data type
            if (is_numeric($a->{'get' . $key}())) {
                return $a->{'get' . $key}() - $b->{'get' . $key}(); // compare numeric
            } else {
                return strnatcasecmp($a->{'get' . $key}(), $b->{'get' . $key}()); // compare string
            }
        };
    }
}
