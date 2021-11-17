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
     * @Route("/api/offer/{offer}/details", name="offer_details", methods={"GET"})
     * @OA\Parameter(name="offer", in="path", description="UUID of offer")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified offer details",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string"),
     *        @OA\Property(property="owner", type="string"),
     *        @OA\Property(property="beer", type="string"),
     *        @OA\Property(property="amount", type="number"),
     *        @OA\Property(property="price", type="number"),
     *        @OA\Property(property="total", type="number"),
     *        @OA\Property(property="location", type="object")
     *     ),
     * )
     *
     * TODO: display details of location property
     */
    public function offerDetails(Offer $offer): Response
    {
        return new JsonResponse($offer->__toArray());
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
     *          @OA\Property(property="total", type="number"),
     *          @OA\Property(property="location", type="object")
     *      )
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfuly added new offer"
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
        return new Response('', 204);
    }

    /**
     * @Route("/api/offer/find/{x}/{y}/{radius}", name="offer_nearby", methods={"GET"})
     * @OA\Parameter(name="x", in="path", description="User's location latitude")
     * @OA\Parameter(name="y", in="path", description="User's location longitude")
     * @OA\Parameter(name="radius", in="path", description="Radius to find offers nearby")
     * @OA\Response(
     *     response=200,
     *     description="Returns list of IDs of offers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(type="string")
     *     )
     * )
     */
    public function nearbyOffers(float $x, float $y, float $radius): Response
    {
        return new Response('Offers nearby...');
    }
}
