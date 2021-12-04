<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\History;
use App\Entity\User;
use App\Repository\HistoryRepository;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
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
    private UserRepository $userRepository;

    private OfferRepository $offerRepository;

    private HistoryRepository $historyRepository;

    public function __construct(
        UserRepository $userRepository,
        OfferRepository $offerRepository,
        HistoryRepository $historyRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->offerRepository = $offerRepository;
        $this->historyRepository = $historyRepository;
    }

    /**
     * @Route("/api/user/{userId}/details", name="user_details", methods={"GET"})
     * @OA\Parameter(name="userId", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns user's details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/User"
     *     ),
     * )
     * @OA\Response(
     *     response=404,
     *     description="User does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function userDetails(string $userId): Response
    {
        $user = $this->userRepository->find($userId);
        if (! $user) {
            return new JsonResponse([
                'message' => sprintf('User %s not found', $userId),
            ], 404);
        }

        return new JsonResponse($user->__toArray());
    }

    /**
     * @Route("/api/user/{userId}/offers", name="user_active_offers", methods={"GET"})
     * @OA\Parameter(name="userId", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns user's active offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Offer")
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="User does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function activeOffers(string $userId): Response
    {
        $user = $this->userRepository->find($userId);
        if (! $user) {
            return new JsonResponse([
                'message' => sprintf('User %s not found', $userId),
            ], 404);
        }

        $offers = $this->offerRepository->findAllByUser($user);

        return new JsonResponse($offers);
    }

    /**
     * @Route("/api/user/{userId}/history", name="user_history", methods={"GET"})
     * @OA\Parameter(name="userId", in="path", description="UUID of user")
     * @OA\Response(
     *     response=200,
     *     description="Returns user's transaction history",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/History")
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="User does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function userHistory(string $userId): Response
    {
        $user = $this->userRepository->find($userId);
        if (! $user) {
            return new JsonResponse([
                'message' => sprintf('User %s not found', $userId),
            ], 404);
        }

        $history = $this->historyRepository->findAllByUser($user);

        return new JsonResponse($history);
    }

    /**
     * @Route("/api/user/{userId}/update", name="user_update", methods={"PUT"})
     * @OA\Parameter(name="userId", in="path", description="UUID of user")
     * @OA\RequestBody(
     *     required=true,
     *     description="User's data that is being updated",
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
     *     description="Successfully changed user's details"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect request",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="User does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function updateUser(string $userId): Response
    {
        $user = $this->userRepository->find($userId);
        if (! $user) {
            return new JsonResponse([
                'message' => sprintf('User %s not found', $userId),
            ], 404);
        }

        // TODO: implement

        return new Response(null, 204);
    }
}
