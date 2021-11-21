<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\History;
use App\Repository\HistoryRepository;
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
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

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
        $allHistory = $this->historyRepository->findAll();
        $res = [];
        foreach ($allHistory as $transaction) {
            $res[] = $transaction->__toArray();
        }

        return new JsonResponse($res);
    }

    /**
     * @Route("/api/history/{historyId}/details", name="history_details", methods={"GET"})
     * @OA\Parameter(name="historyId", in="path", description="UUID of transaction")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified transaction details",
     *     @OA\JsonContent(
     *        ref="#/components/schemas/History"
     *     ),
     * )
     * @OA\Response(
     *     response=404,
     *     description="Transaction does not exist",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function historyDetails(string $historyId): Response
    {
        $history = $this->historyRepository->find($historyId);
        if (! $history) {
            return new JsonResponse([
                'message' => sprintf('Transaction %s not found', $historyId),
            ], 404);
        }

        return new JsonResponse($history->__toArray());
    }
}
