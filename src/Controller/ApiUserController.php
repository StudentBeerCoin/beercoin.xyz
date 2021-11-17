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
    public function userDetails(User $user): Response
    {
        return new JsonResponse($user->__toArray());
    }

    /**
     * @Route("/api/user/{user}/update", name="user_update", methods={"PUT"})
     * @OA\Parameter(name="user", in="path", description="UUID of user")
     * @OA\RequestBody(
     *     required=true,
     *     description="User data that is being updated",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="username", type="string"),
     *        @OA\Property(property="name", type="string"),
     *        @OA\Property(property="surname", type="string"),
     *        @OA\Property(property="email", type="string"),
     *        @OA\Property(property="phoneNumber", type="string"),
     *     ),
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfuly changed user's details"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect request",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function updateDetails(User $user): Response
    {
        return new Response(null, 204);
    }

    /**
     * @Route("/api/user/{user}/offers", name="user_active_offers", methods={"GET"})
     * @OA\Parameter(name="user", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns IDs of user's active offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(type="string")
     *     )
     * )
     */
    public function activeOffers(User $user): Response
    {
        return new JsonResponse([]);
    }
}
