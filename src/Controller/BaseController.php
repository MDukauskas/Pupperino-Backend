<?php

namespace App\Controller;

use App\Repository\ExerciseRepository;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/", name="homepage")
     */
    public function home(ExerciseRepository $exerciseRepository)
    {
        return $this->render('home.html.twig', ['exercises' => $exerciseRepository->findAll()]);
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
        ), Response::HTTP_OK, [], true);
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
            'status' => Response::HTTP_OK,
        ];

        return new JsonResponse($data, Response::HTTP_OK);
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
            'status' => Response::HTTP_BAD_REQUEST,
        ];

        return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
    }
}
