<?php

namespace App\Controller;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @return JsonResponse
     *
     * @throws \InvalidArgumentException
     */
    public function jsonResponse($data): JsonResponse
    {
        return new JsonResponse($this->serializer->serialize(
            $data, 'json', (new SerializationContext())->setSerializeNull(true)
        ), 200, [], true);
    }

    /**
     * @param string|null $message
     *
     * @return JsonResponse
     */
    public function getSuccessResponse(string $message = null): JsonResponse
    {
        $data = [
            'message' => $message ?? 'Success',
            'status' => 200
        ];

        return new JsonResponse($this->serializer->serialize($data, 'json'), 400, [], true);
    }

    /**
     * @param string|null $message
     *
     * @return JsonResponse
     */
    public function errorResponse(string $message = null): JsonResponse
    {
        $data = [
            'message' => $message ?? 'Opsss... Something went wrong.',
            'status' => 400
        ];

        return new JsonResponse($this->serializer->serialize($data, 'json'), 400, [], true);
    }
}
