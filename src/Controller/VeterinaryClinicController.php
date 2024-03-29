<?php

namespace App\Controller;

use App\Kernel;
use App\Service\GoogleMapPlacesParser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 */
class VeterinaryClinicController extends BaseController
{
    /**
     * @Route("api/v0/vets_clinics/list", name="veterinary_clinic_list", methods={"GET"})
     * @param Request $request
     * @param GoogleMapPlacesParser $googleMapPlacesParser
     * @return JsonResponse
     */
    public function veterinaryClinicsList(Request $request, GoogleMapPlacesParser $googleMapPlacesParser)
    {
        try {
//            if (!$request->get('latitude') || !$request->get('longitude')) {
//                throw new \InvalidArgumentException('Empty Latitude and Longitude');
//            }

//            $vetsList = $googleMapPlacesParser->getVetsClinicsList('54.8997654', '23.9615957');
//            $vetsList = $googleMapPlacesParser->getVetsClinicsList($request->get('latitude'), $request->get('longitude'));

            /**
             * @TODO: remove
             */
            $vetsList = $this->getFallback();
        } catch (\Exception $e) {
            $vetsList = $this->getFallback();

//            return $this->errorResponse($e->getMessage());
        }

        return $this->jsonResponse($vetsList);
    }

    /**
     * @Route("/vets-clinics-list", name="vets_clinics_list_twig", methods={"GET"})

     * @return Response
     *
     * @throws \InvalidArgumentException
     */
    public function vetsClinicsListTwig(): Response
    {
        $list = $this->getFallback();

        return $this->render('vets-clinics-list.html.twig', ['vets' => $list]);
    }

    /**
     * @return string
     */
    private function getFallback()
    {
        return json_decode(
            file_get_contents(Kernel::ROOT_DIR . 'public/places.json'),
            true
        );
    }
}
