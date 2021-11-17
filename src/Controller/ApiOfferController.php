<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offer;
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
     * @Route("/api/offer/{offer}/details", name="offer_details", methods={"GET"})
     * @OA\Parameter(name="offer", in="path", description="UUID of offer")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified offer details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/Offer"
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
    public function offerDetails(Offer $offer): Response
    {
        return new JsonResponse($offer->__toArray());
    }

    /**
     * @Route("/api/offer/find/{x}/{y}/{radius}", name="offer_nearby", methods={"GET"})
     * @OA\Parameter(name="x", in="path", description="User's location latitude")
     * @OA\Parameter(name="y", in="path", description="User's location longitude")
     * @OA\Parameter(name="radius", in="path", description="Radius to find offers nearby")
     * @OA\Response(
     *     response=200,
     *     description="Returns list of offers nearby",
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
        return new Response(null, 204);
    }

    /**
     * @Route("/api/offer/{offer}/buy", name="offer_buy", methods={"POST"})
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
    public function buyOffer(Offer $offer): Response
    {
        return new Response(null, 204);
    }

    /**
     * @Route("/api/offer/{offer}/update", name="offer_update", methods={"PUT"})
     * @OA\Parameter(name="offer", in="path", description="UUID of offer")
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
    public function updateOffer(Offer $offer): Response
    {
        return new Response(null, 204);
    }

    /**
     * @Route("/api/offer/{offer}/delete", name="offer_delete", methods={"DELETE"})
     * @OA\Parameter(name="offer", in="path", description="UUID of offer")
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
    public function deleteOffer(Offer $offer): Response
    {
        return new Response(null, 204);
    }
}
