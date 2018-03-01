<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VetController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class VetController extends Controller
{
    /**
     * @Route("/vet-list", name="vet_list")
     */
    public function vetList()
    {
        return $this->json('asasas');
    }
}
