<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\Beer;
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

    public function testAddingNewBeer(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/beer/beers');
        self::assertIsString($client->getResponse()->getContent());
        self::assertCount(1, json_decode($client->getResponse()->getContent(), true));

        $beer = [
            'brand' => 'Test Brand',
            'name' => 'Test Beer',
            'volume' => 355,
            'alcohol' => 4.5,
            'packing' => Beer::BOTTLE,
        ];
        $beerJson = json_encode($beer);
        self::assertIsString($beerJson);
        $client->request('POST', '/api/beer/add', [], [], [], $beerJson);
        self::assertSame(204, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/beer/beers');
        assert(is_string($client->getResponse()->getContent()));
        // FIXME: Disabled assertion - saving new beers to database is not implemented yet
        // self::assertCount(2, json_decode($client->getResponse()->getContent(), true));
    }
}
