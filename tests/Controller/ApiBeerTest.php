<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiBeerTest extends WebTestCase
{
    public function testBeerDetails(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/beer/00000000-0000-0000-0000-000000000001/details');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
    }
}
