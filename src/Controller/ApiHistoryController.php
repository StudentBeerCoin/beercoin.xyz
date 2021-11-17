<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\History;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="History")
 */
class ApiHistoryController extends AbstractController
{
    /**
     * @Route("/api/history/transactions", name="history_list", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns all transactions history",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/History")
     *     )
     * )
     */
    public function listHistory(): Response
    {
        return new JsonResponse([]);
    }

    /**
     * @Route("/api/history/{history}/details", name="history_details", methods={"GET"})
     * @OA\Parameter(name="history", in="path", description="UUID of transaction")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified transaction details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/History"
     *     ),
     * )
     */
    public function historyDetails(History $history): Response
    {
        return new JsonResponse($history->__toArray());
    }
}
