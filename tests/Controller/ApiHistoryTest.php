<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiHistoryTest extends WebTestCase
{
    public function testHistoryDetails(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/history/00000000-0000-0000-0000-000000000001/details');

        self::assertResponseIsSuccessful();
        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
    }

    public function testHistoryDetailsNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/history/t_unknown/details');

        self::assertSame('application/json', $client->getResponse()->headers->get('content-type'));
        self::assertIsString($client->getResponse()->getContent());
        self::assertSame([
            'message' => 'Transaction t_unknown not found',
        ], json_decode($client->getResponse()->getContent(), true));
        self::assertSame(404, $client->getResponse()->getStatusCode());
    }

    public function testListingAllTransactionsHistory(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/history/transactions');

        self::assertResponseIsSuccessful();
        self::assertIsString($client->getResponse()->getContent());
        self::assertCount(1, json_decode($client->getResponse()->getContent(), true));
    }
}
