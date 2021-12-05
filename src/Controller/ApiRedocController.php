<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @codeCoverageIgnore
 */
class ApiRedocController extends AbstractController
{
    /**
     * @Route("/api/redoc", name="api_redoc", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('api_redoc/index.html.twig');
    }
}
