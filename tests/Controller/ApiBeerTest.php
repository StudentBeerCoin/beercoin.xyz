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

    public function testBeerDetailsNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/beer/t_unknown/details');

        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'Beer t_unknown not found',
        ], json_decode($client->getResponse()->getContent(), true));
        self::assertSame(404, $client->getResponse()->getStatusCode());
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
            'packing' => 'bottle',
        ];
        $beerJson = json_encode($beer);
        self::assertIsString($beerJson);
        $client->request('POST', '/api/beer/add', [], [], [], $beerJson);
        self::assertSame(204, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/beer/beers');
        self::assertIsString($client->getResponse()->getContent());
//        FIXME: writing to database disabled for security reasons
//        self::assertCount(2, json_decode($client->getResponse()->getContent(), true));
    }

    public function testAddingNewBeerWithIncorrectRequest(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/beer/beers');
        self::assertIsString($client->getResponse()->getContent());
        self::assertCount(1, json_decode($client->getResponse()->getContent(), true));

        $beer = [
            'brand' => 'Test Brand',
            'name' => 'Test Beer',
        ];
        $beerJson = json_encode($beer);
        self::assertIsString($beerJson);
        $client->request('POST', '/api/beer/add', [], [], [], $beerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params: volume, alcohol, packing',
        ], json_decode($client->getResponse()->getContent(), true));
    }

    public function testAddingNewBeerWithIncorrectPacking(): void
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
            'packing' => 'paper bag',
            // this is obviously wrong
        ];
        $beerJson = json_encode($beer);
        self::assertIsString($beerJson);
        $client->request('POST', '/api/beer/add', [], [], [], $beerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Incorrect packing type - allowed values: can, bottle',
        ], json_decode($client->getResponse()->getContent(), true));
    }
}
