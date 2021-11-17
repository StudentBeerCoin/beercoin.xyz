<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Beer;
use App\Repository\BeerRepository;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Beer")
 */
class ApiBeerController extends AbstractController
{
    private BeerRepository $beerRepository;

    public function __construct(BeerRepository $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    /**
     * @Route("/api/beer/beers", name="beer_list", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns all beers",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/Beer")
     *     )
     * )
     */
    public function listBeers(): Response
    {
        $beers = $this->beerRepository->findAll();
        $res = [];
        foreach ($beers as $beer) {
            $res[] = $beer->getId();
        }

        return new JsonResponse($res);
    }

    /**
     * @Route("/api/beer/{beer}/details", name="beer_details", methods={"GET"})
     * @OA\Parameter(
     *     name="beer",
     *     in="path",
     *     description="UUID of beer"
     * )
     * @OA\Response(
     *     response=200,
     *     description="Returns specified beer details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/Beer"
     *     )
     * )
     * @OA\Response(
     *     response=404,
     *     description="Beer not found",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string"),
     *        @OA\Property(property="message", type="string"),
     *     )
     * )
     */
    public function beerDetails(Beer $beer): Response
    {
        return new JsonResponse($beer->__toArray());
    }

    /**
     * @Route("/api/beer/add", name="beer_add", methods={"POST"})
     * @OA\RequestBody(
     *       required=true,
     *       description="Beer data",
     *       @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="brand", type="string"),
     *          @OA\Property(property="name", type="string"),
     *          @OA\Property(property="volume", type="number"),
     *          @OA\Property(property="alcohol", type="number"),
     *          @OA\Property(property="packing", type="string")
     *      )
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successfully added new beer"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect beer details",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function addBeer(): Response
    {
        return new Response(null, 204);
    }
}
