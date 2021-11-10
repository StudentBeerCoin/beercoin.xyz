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
}
