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
     * @Route("/api/history/{history}/details", name="history_details", methods={"GET"})
     * @OA\Parameter(name="history", in="path", description="UUID of transaction")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified transaction details",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string"),
     *        @OA\Property(property="offer", type="string"),
     *        @OA\Property(property="counterparty", type="string"),
     *        @OA\Property(property="amount", type="number")
     *     ),
     * )
     */
    public function historyDetails(History $history): Response
    {
        return new JsonResponse($history->__toArray());
    }
}
