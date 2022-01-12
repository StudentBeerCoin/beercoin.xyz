<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiAssetsTest extends WebTestCase
{
    public function testDefaultBeerThumbnail(): void
    {
        $client = static::createClient();

        // This asset does not exist
        $client->request('GET', '/api/assets/beer/t_unknown');
        self::assertResponseIsSuccessful();
        $notFound = $client->getResponse()->getContent();

        $client->request('GET', '/api/assets/beer/_unknown');
        self::assertResponseIsSuccessful();
        $defaultThumb = $client->getResponse()->getContent();

        self::assertSame($defaultThumb, $notFound);
    }
}
