<?php

namespace App\Controller;

use App\Repository\ProfileDogRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class VetController extends Controller
{
    /**
     * @Rest\Route("/vet-list", name="vet_list")
     * @param ProfileDogRepository $profileDogRepository
     * @return Response
     */
    public function vetList(ProfileDogRepository $profileDogRepository)
    {
        $dogies = $profileDogRepository->findAll();

        $jms = $this->get('jms_serializer');

        return new Response($jms->serialize($dogies, 'json'));
    }
}
