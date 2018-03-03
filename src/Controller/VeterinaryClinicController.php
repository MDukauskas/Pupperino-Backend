<?php

namespace App\Controller;

use App\Service\GoogleMapPlacesParser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class VeterinaryClinicController extends BaseController
{
    /**
     * @Route("/vets_clinics/list", name="veterinary_clinic_list", methods={"POST"})
     * @param Request $request
     * @param GoogleMapPlacesParser $googleMapPlacesParser
     * @return JsonResponse
     */
    public function veterinaryClinicList(Request $request, GoogleMapPlacesParser $googleMapPlacesParser)
    {
        try {
            if (!$request->get('latitude') || !$request->get('longitude')) {
                throw new \InvalidArgumentException('Empty Latitude and Longitude');
            }

//            $vetsList = $googleMapPlacesParser->getVetsList('55.358424', '23.967773');
            $vetsList = $googleMapPlacesParser->getVetsList($request->get('latitude'), $request->get('longitude'));

            return $this->jsonResponse($vetsList);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
