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
     *     description="Returns user details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/User"
     *     ),
     * )
     */
    public function userDetails(User $user): Response
    {
        return new JsonResponse($user->__toArray());
    }

    /**
     * @Route("/api/user/{user}/offers", name="user_active_offers", methods={"GET"})
     * @OA\Parameter(name="user", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns user's active offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Offer")
     *     )
     * )
     */
    public function activeOffers(User $user): Response
    {
        return new JsonResponse([]);
    }

    /**
     * @Route("/api/user/{user}/history", name="user_history", methods={"GET"})
     * @OA\Parameter(name="user", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns user's transaction history",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/History")
     *     )
     * )
     */
    public function userHistory(User $user): Response
    {
        return new JsonResponse([]);
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
     *        @OA\Property(property="location", ref="#/components/schemas/Location")
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
    public function updateUser(User $user): Response
    {
        return new Response(null, 204);
    }
}
