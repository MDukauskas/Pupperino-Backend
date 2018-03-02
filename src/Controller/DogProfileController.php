<?php

namespace App\Controller;

use App\Entity\ProfileDog;
use App\Repository\ProfileDogRepository;
use App\Service\DogService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @Route("/dog/{id}", name="dog_profile", methods={"GET"})
     *
     * @param ProfileDogRepository $profileDogRepository
     * @param int                  $id
     *
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    public function getProfile(ProfileDogRepository $profileDogRepository, int $id): JsonResponse
    {
        $dog = $profileDogRepository->find($id);

        if (null === $dog) {
            return $this->jsonResponse('error');
        }

        return $this->jsonResponse($dog);
    }

    /**
     * @Route("/dog/update/{id}", name="dog_profile_update", methods={"POST"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $em
     * @param int                    $id
     * @param DogService             $dogService
     *
     * @return JsonResponse
     * @internal param SerializerInterface $serializer
     */
    public function updateProfile(Request $request, EntityManagerInterface $em, DogService $dogService, int $id): JsonResponse
    {
        /**
         * @var ProfileDog $dog
         */
        $dog = $em->getRepository(ProfileDog::class)->find($id);

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

    /**
     * @param Request              $request
     * @param DogService           $dogService
     * @param EntityManagerInterface $em
     * @param int                  $id
     *
     * @return JsonResponse
     *
     * @Route("/picture/dog/{id}", name="picture_upload", methods={"POST"})
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function uploadImage(
        Request $request,
        DogService $dogService,
        EntityManagerInterface $em,
        int $id
    )
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        if ($file instanceof UploadedFile) {
            $uploadedFile = $dogService->processFile($file);

            /** @var ProfileDog $dog */
            $dog = $em->getRepository(ProfileDog::class)->find($id);

            if (null === $dog) {
                return $this->errorResponse('Doggo not found');
            }

            $dog->setPicture($uploadedFile);
            $em->persist($dog);
            $em->flush();

            return $this->jsonResponse(
                ['fileName' => $uploadedFile]
            );
        }

        return $this->errorResponse('Nice picture of puppy, was not uploaded...');
    }
}
