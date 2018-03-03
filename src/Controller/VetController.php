<?php

namespace App\Controller;

use App\Entity\Vet;
use App\Repository\VetRepository;
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
     * @Route("/vet/list", name="vet_list", methods={"GET"})
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
}
