<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\ProfileDog;
use App\Service\ExerciseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExerciseController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class ExerciseController extends BaseController
{
    /**
     * @Route("/exercise/store/{id}", name="exercise_store", methods={"POST"})
     *
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @param ExerciseService        $exerciseService
     * @param int                    $id Dog Id.
     *
     * @return JsonResponse
     */
    public function storeExercise(
        Request $request,
        EntityManagerInterface $entityManager,
        ExerciseService $exerciseService,
        int $id
    ): JsonResponse {
        $dog = $entityManager->getRepository(ProfileDog::class)->find($id);

        if (null === $dog) {
            return $this->errorResponse('Dog not found');
        }

        $exercise = $exerciseService->createExercise($request->request->all(), $dog);

        $entityManager->persist($exercise);
        $entityManager->flush();

        return $this->getSuccessResponse('Exercise created');
    }

    /**
     * @Route("/exercise/list/{id}", name="exercise_list", methods={"GET"})
     *
     * @param EntityManagerInterface $entityManager
     * @param int                    $id
     *
     * @return JsonResponse
     *
     * @throws \InvalidArgumentException
     */
    public function getExerciseList(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $dog = $entityManager->getRepository(ProfileDog::class)->find($id);

        if (null === $dog) {
            return $this->errorResponse('Dog not found');
        }
        
        $exerciseList = $entityManager->getRepository(Exercise::class)
            ->getExercises($id);

        if (null === $exerciseList) {
            $this->getSuccessResponse('You need to exercise first!');
        }

        return $this->jsonResponse($exerciseList);
    }
}
