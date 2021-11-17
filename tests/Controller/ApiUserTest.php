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

    public function testUpdatingUserData(): void
    {
        $client = static::createClient();

        $user = [
            'username' => 't_newUsername',
            'name' => 't_newName',
            'surname' => 't_newSurname',
            'email' => 't_newEmail@example.com',
            'phoneNumber' => '999999999',
        ];
        $userJson = json_encode($user);
        self::assertIsString($userJson);
        $client->request('PUT', '/api/user/00000000-0000-0000-0000-000000000001/update', [], [], [], $userJson);
    }
}
