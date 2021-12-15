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
        $data = json_decode($client->getResponse()->getContent(), true);
        foreach ($data as $offer) {
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
        $data = json_decode($client->getResponse()->getContent(), true);
        self::assertCount(2, $data);
    }

    public function testListingOffersForSale(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/offer/sell/offers');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        foreach ($data as $offer) {
            self::assertSame('sell', $offer['type']);
        }
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
        $jsonResponse = json_decode($client->getResponse()->getContent(), true);
        self::assertSame($offer['amount'] * $offer['price'], $jsonResponse['total']);
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
    }
}
