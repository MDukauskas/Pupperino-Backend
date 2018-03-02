<?php

namespace App\Controller;

use App\Entity\ProfileDog;
use App\Repository\ProfileDogRepository;
use App\Service\DogService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DogProfileController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class DogProfileController extends BaseController
{
    /**
     * @Route("/profile/{id}/dog", name="dog_profile", methods={"GET"})
     *
     * @param ProfileDogRepository $profileDogRepository
     * @param int                  $id
     *
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    public function getProfile(ProfileDogRepository $profileDogRepository, int $id): JsonResponse {
        $dog = $profileDogRepository->find($id);

        if (null === $dog) {
            return $this->jsonResponse('error');
        }

        return $this->jsonResponse($dog);
    }

    /**
     * @Route("/profile/update", name="dog_profile_update", methods={"POST"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     *
     * @param DogService             $dogService
     *
     * @return JsonResponse
     * @internal param SerializerInterface $serializer
     */
    public function updateProfile(Request $request, EntityManagerInterface $em, DogService $dogService): JsonResponse
    {
        if (null === $request->get('id')) {
            return $this->errorResponse();
        }
        /**
         * @var ProfileDog $dog
         */
        $dog = $em->getRepository(ProfileDog::class)->find($request->get('id'));

        if (null === $dog->getId()) {
            return $this->errorResponse('Doggo not found!');
        }

        $dog = $dogService->createDog($request->request->all());

        if ($dog instanceof ProfileDog) {
            $em->persist($dog);
            $em->flush();

            return $this->getSuccessResponse('Doggo updated!');
        }

        return $this->errorResponse('You failed!');
    }
}
