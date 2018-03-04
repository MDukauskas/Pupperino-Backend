<?php

namespace App\Controller;

use App\Entity\Vet;
use App\Repository\ExerciseRepository;
use App\Repository\VetRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 */
class VetController extends BaseController
{
    /**
     * @Route("/dashboards", name="homepage")
     */
    public function home(ExerciseRepository $exerciseRepository)
    {
        return $this->render('home.html.twig', ['exercises' => $exerciseRepository->findAll()]);
    }

    /**
     * @Route("api/v0/vet/list", name="api_v0_vet_list", methods={"GET"})
     *
     * @param VetRepository $vetRepository
     *
     * @return JsonResponse
     *
     * @throws \InvalidArgumentException
     */
    public function vetList(VetRepository $vetRepository)
    {
        $list = $vetRepository->findAll();

        $vetList = [];
        /** @var Vet $item */
        foreach ($list as $item) {
            $vetList[] = $item->setOpen($item->isOpen());
        }

        return $this->jsonResponse($vetList);
    }

    /**
     * @Route("vet-list", name="vet_list_twig", methods={"GET"})
     *
     * @param VetRepository $vetRepository
     *
     * @return Response
     *
     * @throws \InvalidArgumentException
     */
    public function vetListTwig(VetRepository $vetRepository): Response
    {
        $list = $vetRepository->findAll();

        $vetList = [];
        /** @var Vet $item */
        foreach ($list as $item) {
            $vetList[] = $item->setOpen($item->isOpen());
        }

        return $this->render('vet-list.html.twig', ['vets' => $vetList]);
    }
}
