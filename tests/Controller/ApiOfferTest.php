<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiOfferTest extends WebTestCase
{
    public function testOfferDetails(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/offer/00000000-0000-0000-0000-000000000001/details');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
    }

    public function testOfferDetailsNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/offer/t_unknown/details');

        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'Offer t_unknown not found',
        ], json_decode($client->getResponse()->getContent(), true));
        self::assertSame(404, $client->getResponse()->getStatusCode());
    }

    public function testListingOffersToBuy(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/offer/buy/offers');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        foreach ($response as $offer) {
            self::assertSame('buy', $offer['type']);
        }
    }

    public function testListingOffers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/offer/offers');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount(2, $response);
    }

    public function testListingOffersForSale(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/offer/sell/offers');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        foreach ($response as $offer) {
            self::assertSame('sell', $offer['type']);
        }
    }

    public function testAddingNewOffer(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $offerCount = count(json_decode($client->getResponse()->getContent(), true));

        $offer = [
            'owner' => '00000000-0000-0000-0000-000000000001',
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
            'type' => 'buy',
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('POST', '/api/offer/add', [], [], [], $offerJson);
        self::assertSame(204, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount($offerCount + 1, $response);
    }

    public function testAddingNewOfferWithIncorrectRequest(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $offerCount = count(json_decode($client->getResponse()->getContent(), true));

        $offer = [
            'owner' => '00000000-0000-0000-0000-000000000001',
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('POST', '/api/offer/add', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params: type',
        ], $response);

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount($offerCount, $response);
    }

    public function testAddingNewOfferWithNotExistingOwner(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $offerCount = count(json_decode($client->getResponse()->getContent(), true));

        $offer = [
            'owner' => 't_unknown',
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
            'type' => 'buy',
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('POST', '/api/offer/add', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'User t_unknown not found',
        ], $response);

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount($offerCount, $response);
    }

    public function testAddingNewOfferWithNotExistingBeer(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $offerCount = count(json_decode($client->getResponse()->getContent(), true));

        $offer = [
            'owner' => '00000000-0000-0000-0000-000000000001',
            'beer' => 't_unknown',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
            'type' => 'buy',
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('POST', '/api/offer/add', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Beer t_unknown not found',
        ], $response);

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount($offerCount, $response);
    }

    public function testAddingNewOfferWithIncorrectLocation(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $offerCount = count(json_decode($client->getResponse()->getContent(), true));

        $offer = [
            'owner' => '00000000-0000-0000-0000-000000000001',
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [1.234, 4.321],
            'type' => 'buy',
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('POST', '/api/offer/add', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params in location: x, y',
        ], $response);

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount($offerCount, $response);
    }

    public function testAddingNewOfferWithIncorrectType(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $offerCount = count(json_decode($client->getResponse()->getContent(), true));

        $offer = [
            'owner' => '00000000-0000-0000-0000-000000000001',
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
            'type' => 'rent',
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('POST', '/api/offer/add', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Incorrect packing type - allowed values: buy, sell',
        ], $response);

        $client->request('GET', '/api/offer/offers');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertCount($offerCount, $response);
    }

    public function testUpdatingOfferData(): void
    {
        $client = static::createClient();

        $offer = [
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('PUT', '/api/offer/00000000-0000-0000-0000-000000000001/update', [], [], [], $offerJson);
        self::assertSame(204, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/offer/00000000-0000-0000-0000-000000000001/details');
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);
        self::assertSame($offer['amount'] * $offer['price'], $response['total']);
    }

    public function testUpdatingNotExistingOfferData(): void
    {
        $client = static::createClient();

        $offer = [
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('PUT', '/api/offer/t_unknown/update', [], [], [], $offerJson);
        self::assertSame(404, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Offer t_unknown not found',
        ], $response);
    }

    public function testUpdatingOfferDataWithIncorrectRequest(): void
    {
        $client = static::createClient();

        $offer = [
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('PUT', '/api/offer/00000000-0000-0000-0000-000000000001/update', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params: beer',
        ], $response);
    }

    public function testUpdatingOfferDataWithNotExistingBeer(): void
    {
        $client = static::createClient();

        $offer = [
            'beer' => 't_unknown',
            'amount' => 123,
            'price' => 3.21,
            'location' => [
                'x' => 1.234,
                'y' => 4.321,
            ],
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('PUT', '/api/offer/00000000-0000-0000-0000-000000000001/update', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Beer t_unknown not found',
        ], $response);
    }

    public function testUpdatingOfferDataWithIncorrectLocation(): void
    {
        $client = static::createClient();

        $offer = [
            'beer' => '00000000-0000-0000-0000-000000000001',
            'amount' => 123,
            'price' => 3.21,
            'location' => [1.234, 4.321],
        ];
        $offerJson = json_encode($offer);
        self::assertIsString($offerJson);
        $client->request('PUT', '/api/offer/00000000-0000-0000-0000-000000000001/update', [], [], [], $offerJson);
        self::assertSame(400, $client->getResponse()->getStatusCode());
        self::assertIsString($client->getResponse()->getContent());
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertSame([
            'message' => 'Incorrect request',
            'details' => 'Missing following params in location: x, y',
        ], $response);
    }
}
