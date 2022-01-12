<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use function PHPUnit\Framework\assertIsString;

/**
 * @OA\Tag(name="Assets")
 */
class ApiAssetsController extends AbstractController
{
    /**
     * @Route("/api/assets/beer/{beerId}", name="beer_image", methods={"GET"})
     * @OA\Parameter(name="beerId", in="path", description="UUID of beer")
     * @OA\Response(
     *     response=200,
     *     description="Returns specified beer image. If image does not exist, default image is returned",
     * )
     */
    public function beerImage(String $beerId): Response
    {
        $rootPath = $this->getParameter('kernel.project_dir');
        assertIsString($rootPath);
        $beerPath = sprintf('%s/public/beers/%s.png', $rootPath, $beerId);

        if (!file_exists($beerPath)) {
            $beerPath = sprintf('%s/public/beers/_unknown.png', $rootPath);
        }

        return new BinaryFileResponse($beerPath);
    }
}
