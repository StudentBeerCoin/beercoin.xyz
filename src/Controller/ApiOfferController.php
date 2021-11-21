<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Offer")
 */
class ApiOfferController extends AbstractController
{
    private OfferRepository $offerRepository;

    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @Route("/api/offer/offers", name="offer_list", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns all offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Offer")
     *     )
     * )
     */
    public function listOffers(): Response
    {
        return new JsonResponse([]);
    }

    /**
     * @Route("/api/offer/offers/buy", name="offer_buy", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns all buying offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Offer")
     *     )
     * )
     */
    public function offersBuy(): Response
    {
        return new JsonResponse([]);
    }

    /**
     * @Route("/api/offer/offers/sell", name="offer_sell", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns all selling offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Offer")
     *     )
     * )
     */
    public function offersSell(): Response
    {
        return new JsonResponse([]);
    }

    /**
     * @Route("/api/offer/{offerId}/details", name="offer_details", methods={"GET"})
     * @OA\Parameter(name="offerId", in="path", description="UUID of offer")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified offer details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/Offer"
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="Offer does not exist",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function offerDetails(string $offerId): Response
    {
        $offer = $this->offerRepository->find($offerId);
        if (! $offer) {
            return new JsonResponse([
                'message' => sprintf('Offer %s not found', $offerId),
            ], 404);
        }

        return new JsonResponse($offer->__toArray());
    }

    /**
     * @Route("/api/offer/find/{x}/{y}/{radius}", name="offer_nearby", methods={"GET"})
     * @OA\Parameter(name="x", in="path", description="User's location latitude")
     * @OA\Parameter(name="y", in="path", description="User's location longitude")
     * @OA\Parameter(name="radius", in="path", description="Radius to find offers nearby")
     * @OA\Response(
     *     response=200,
     *     description="Returns list of offers nearby specified location",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Offer")
     *     )
     * )
     */
    public function nearbyOffers(float $x, float $y, float $radius): Response
    {
        return new JsonResponse([]);
    }

    /**
     * @Route("/api/offer/add", name="offer_add", methods={"POST"})
     * @OA\RequestBody(
     *       required=true,
     *       description="Offer data",
     *       @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="owner", type="string"),
     *          @OA\Property(property="beer", type="string"),
     *          @OA\Property(property="amount", type="number"),
     *          @OA\Property(property="price", type="number"),
     *          @OA\Property(property="location", type="object"),
     *          @OA\Property(property="type", type="string")
     *      )
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfully added new offer"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect offer details",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function addOffer(): Response
    {
        // TODO: create new offer

        return new Response(null, 204);
    }

    /**
     * @Route("/api/offer/{offerId}/buy", name="offer_buy", methods={"POST"})
     * @OA\Parameter(name="offerId", in="path", description="UUID of offer")
     * @OA\RequestBody(
     *       required=true,
     *       description="Offer data",
     *       @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="buyer", type="string"),
     *          @OA\Property(property="amount", type="number")
     *      )
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfully made transaction"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect offer details",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="Offer does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function buyOffer(string $offerId): Response
    {
        $offer = $this->offerRepository->find($offerId);
        if (! $offer) {
            return new JsonResponse([
                'message' => sprintf('Offer %s not found', $offerId),
            ], 404);
        }

        return new Response(null, 204);
    }

    /**
     * @Route("/api/offer/{offerId}/update", name="offer_update", methods={"PUT"})
     * @OA\Parameter(name="offerId", in="path", description="UUID of offer")
     * @OA\RequestBody(
     *     required=true,
     *     description="Offer data that is being updated",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="beer", type="string"),
     *        @OA\Property(property="amount", type="number"),
     *        @OA\Property(property="price", type="number"),
     *        @OA\Property(property="location", ref="#/components/schemas/Location"),
     *     ),
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfully changed offer's details"
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
     *     description="Offer does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function updateOffer(string $offerId): Response
    {
        $offer = $this->offerRepository->find($offerId);
        if (! $offer) {
            return new JsonResponse([
                'message' => sprintf('Offer %s not found', $offerId),
            ], 404);
        }

        // TODO: update offer

        return new Response(null, 204);
    }

    /**
     * @Route("/api/offer/{offerId}/delete", name="offer_delete", methods={"DELETE"})
     * @OA\Parameter(name="offerId", in="path", description="UUID of offer")
     * @OA\RequestBody(
     *     required=true,
     *     description="Owner's authentication data",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="user", type="string"),
     *        @OA\Property(property="password", type="string")
     *     ),
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfully removed offer"
     * )
     * @OA\Response(
     *     response=404,
     *     description="Offer does not exists",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function deleteOffer(string $offerId): Response
    {
        $offer = $this->offerRepository->find($offerId);
        if (! $offer) {
            return new JsonResponse([
                'message' => sprintf('Offer %s not found', $offerId),
            ], 404);
        }

        // TODO: remove offer

        return new Response(null, 204);
    }
}
