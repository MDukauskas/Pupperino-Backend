<?php

namespace App\Controller;

use App\Service\GoogleMapPlacesParser;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class VetController extends BaseController
{
    /**
     * @Rest\Route("/vet-list", name="vet_list")
     * @param GoogleMapPlacesParser $googleMapPlacesParser
     * @return JsonResponse
     */
    public function vetList(GoogleMapPlacesParser $googleMapPlacesParser)
    {
        $test = $googleMapPlacesParser->getVetsList('55.358424', '23.967773');

        return $this->jsonResponse($test);
    }
}
