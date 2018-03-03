<?php

namespace App\Controller;

use App\Repository\VetRepository;
use App\Service\GoogleMapPlacesParser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class VetController extends BaseController
{
    /**
     * @Route("/vet/list", name="vet_list", methods={"GET"})
     *
     * @param VetRepository $vetRepository
     *
     * @return JsonResponse
     */
    public function vetList(VetRepository $vetRepository)
    {
        return $this->jsonResponse($vetRepository->findAll());
    }

    /**
     * @Route("/institution/list", name="institution_list", methods={"GET"})
     * @param Request $request
     * @param GoogleMapPlacesParser $googleMapPlacesParser
     * @return JsonResponse
     */
    public function institutionList(Request $request, GoogleMapPlacesParser $googleMapPlacesParser)
    {
        try {
            if (!$request->get('latitude') || !$request->get('longitude')) {
                throw new \InvalidArgumentException('Empty Latitude and Longitude');
            }

//            $vetsList = $googleMapPlacesParser->getVetsList('55.358424', '23.967773');
            $institutionList = $googleMapPlacesParser->getVetsList($request->get('latitude'), $request->get('longitude'));

            return $this->jsonResponse($institutionList);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
