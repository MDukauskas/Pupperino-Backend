<?php

namespace App\Controller;

use App\Repository\ProfileDogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DogProfileController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class DogProfileController extends BaseController
{
    /**
     * @Route("/profile/{id}/dog", name="dog_profile")
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     *
     * @throws \InvalidArgumentException
     */
    public function getProfile(
        Request $request,
        ProfileDogRepository $profileDogRepository,
        int $id
    )
    {
        $dog = $profileDogRepository->find($id);

        if (null === $dog) {
            return new Response('Error');
        }

        return $this->jsonResponse($dog);
    }
}
