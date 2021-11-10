<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\History;
use App\Entity\User;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="User")
 */
class ApiUserController extends AbstractController
{
    /**
     * @Route("/api/user/{user}/details", name="user_details", methods={"GET"})
     * @OA\Parameter(name="user", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified history details",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string"),
     *        @OA\Property(property="username", type="string"),
     *        @OA\Property(property="name", type="string"),
     *        @OA\Property(property="surname", type="string"),
     *        @OA\Property(property="email", type="string"),
     *        @OA\Property(property="phoneNumber", type="string"),
     *        @OA\Property(property="balance", type="number"),
     *        @OA\Property(property="location", type="object")
     *     ),
     * )
     *
     * TODO: display details of location property
     */
    public function historyDetails(User $user): Response
    {
        return new JsonResponse($user->__toArray());
    }
}
