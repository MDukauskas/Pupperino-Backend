<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DogProfileController.
 *
 * @Route("api/v0", name="api_v0_")
 */
class DogProfileController extends Controller
{
    /**
     * @Route("/profile/{id}/dog", name="dog_profile")
     *
     * @param int $id
     */
    public function getProfile(int $id)
    {

    }
}
