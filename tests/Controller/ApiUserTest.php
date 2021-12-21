<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiUserTest extends WebTestCase
{
    public function testUserDetails(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/00000000-0000-0000-0000-000000000001/details');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
    }

    public function testUserDetailsNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/t_unknown/details');

        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'User t_unknown not found',
        ], json_decode($client->getResponse()->getContent(), true));
        self::assertSame(404, $client->getResponse()->getStatusCode());
    }

    public function testListUsersOffers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/00000000-0000-0000-0000-000000000001/offers');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        foreach ($response as $offer) {
            self::assertSame('00000000-0000-0000-0000-000000000001', $offer['owner']['id']);
        }
    }

    public function testListNotExistingUsersOffers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/t_unknown/offers');

        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'User t_unknown not found',
        ], json_decode($client->getResponse()->getContent(), true));
        self::assertSame(404, $client->getResponse()->getStatusCode());
    }

    public function testListUsersHistory(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/00000000-0000-0000-0000-000000000002/history');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        foreach ($response as $history) {
            self::assertSame('00000000-0000-0000-0000-000000000002', $history['counterparty']['id']);
        }
    }

    public function testListNotExistingUsersHistory(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/t_unknown/history');

        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'User t_unknown not found',
        ], json_decode($client->getResponse()->getContent(), true));
        self::assertSame(404, $client->getResponse()->getStatusCode());
    }

    public function testUpdatingUserData(): void
    {
        $client = static::createClient();

        $user = [
            'username' => 't_newUsername',
            'name' => 't_newName',
            'surname' => 't_newSurname',
            'email' => 't_newEmail@example.com',
            'phoneNumber' => '999999999',
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $userJson = json_encode($user);
        self::assertIsString($userJson);
        $client->request('PUT', '/api/user/00000000-0000-0000-0000-000000000001/update', [], [], [], $userJson);

        self::assertResponseIsSuccessful();
        self::assertSame(204, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/user/00000000-0000-0000-0000-000000000001/details');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        foreach ($user as $key => $value) {
            self::assertSame($value, $response[$key]);
        }
    }

    public function testUpdatingNotExistingUserData(): void
    {
        $client = static::createClient();

        $user = [
            'username' => 't_newUsername',
            'name' => 't_newName',
            'surname' => 't_newSurname',
            'email' => 't_newEmail@example.com',
            'phoneNumber' => '999999999',
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $userJson = json_encode($user);
        self::assertIsString($userJson);
        $client->request('PUT', '/api/user/t_unknown/update', [], [], [], $userJson);
        self::assertSame(404, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'User t_unknown not found',
        ], $response);
    }

    public function testUpdatingOfferDataWithIncorrectRequest(): void
    {
        $client = static::createClient();

        $user = [
            'username' => 't_newUsername',
            'name' => 't_newName',
            'surname' => 't_newSurname',
            'email' => 't_newEmail@example.com',
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $userJson = json_encode($user);
        self::assertIsString($userJson);
        $client->request('PUT', '/api/user/00000000-0000-0000-0000-000000000001/update', [], [], [], $userJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params: phoneNumber',
        ], $response);
    }

    public function testUpdatingOfferDataWithIncorrectLocation(): void
    {
        $client = static::createClient();

        $user = [
            'username' => 't_newUsername',
            'name' => 't_newName',
            'surname' => 't_newSurname',
            'email' => 't_newEmail@example.com',
            'phoneNumber' => '999999999',
            'location' => [1.234, 4.321],
        ];
        $userJson = json_encode($user);
        self::assertIsString($userJson);
        $client->request('PUT', '/api/user/00000000-0000-0000-0000-000000000001/update', [], [], [], $userJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params in location: x, y',
        ], $response);
    }
}
