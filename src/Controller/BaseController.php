<?php

namespace App\Controller;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseController.
 */
class BaseController extends Controller
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     *
     * @return Response
     *
     * @throws \InvalidArgumentException
     */
    public function jsonResponse($data): Response
    {
        return new Response($this->serializer->serialize(
            $data, 'json', (new SerializationContext())->setSerializeNull(true)
        ));
    }
}
