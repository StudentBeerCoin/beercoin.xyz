<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function beerImage(string $beerId): Response
    {
        /**
         * @phpstan-ignore-next-line
         */
        $rootPath = (string) $this->getParameter('kernel.project_dir');
        $beerPath = sprintf('%s/public/beers/%s.png', $rootPath, $beerId);

        if (! file_exists($beerPath)) {
            $beerPath = sprintf('%s/public/beers/_unknown.png', $rootPath);
        }

        return new BinaryFileResponse($beerPath);
    }
}
