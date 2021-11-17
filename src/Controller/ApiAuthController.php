<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Auth")
 */
class ApiAuthController extends AbstractController
{
    /**
     * @Route("/api/register", name="register", methods={"POST"})
     * @OA\RequestBody(
     *       required=true,
     *       description="User data needed to successful registration",
     *       @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="email", type="string"),
     *          @OA\Property(property="username", type="string"),
     *          @OA\Property(property="password", type="string"),
     *      )
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successful registration"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect request",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function register(): Response
    {
        return new Response(null, 204);
    }

    /**
     * @Route("/api/login", name="login", methods={"POST"})
     * @OA\RequestBody(
     *       required=true,
     *       description="Login data",
     *       @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="username", type="string"),
     *          @OA\Property(property="password", type="string"),
     *      )
     * )
     * @OA\Response(
     *     response=204,
     *     description="Successful login"
     * )
     * @OA\Response(
     *     response=400,
     *     description="Incorrect request",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="message", type="string")
     *     )
     * )
     */
    public function login(): Response
    {
        return new Response(null, 204);
    }
}
