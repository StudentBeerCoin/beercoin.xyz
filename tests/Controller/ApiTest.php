<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    public function testApiControlMessage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('', 'API is working!');
    }
}
