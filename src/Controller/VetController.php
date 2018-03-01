<?php

namespace App\Controller;

use App\Entity\ProfileDog;
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
     *
     */
    public function vetList()
    {
        $doggos = $this->getDoctrine()->getManager()->getRepository(ProfileDog::class)->findAll();

        $jms = $this->container->get('jms_serializer');


        return new Response($jms->serialize($doggos, 'json'));
    }
}
