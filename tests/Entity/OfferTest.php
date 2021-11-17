<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Beer;
use App\Entity\Offer;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    public function testEntityGettersSetters(): void
    {
        $user = new User();
        $beer = new Beer();
        $offer = new Offer();

        // Check defaults
        self::assertNotNull($offer->getId());
        self::assertSame(1, $offer->getAmount());
        self::assertSame(50.0687252, $offer->getLocationX());
        self::assertSame(19.9066193, $offer->getLocationY());
        self::assertSame([$offer->getLocationX(), $offer->getLocationY()], $offer->getLocation());
        self::assertTrue($offer->isSelling());
        self::assertFalse($offer->isBuying());

        // Set custom offer properties
        $offer->setOwner($user);
        $offer->setBeer($beer);
        $offer->setAmount(5);
        $offer->setPrice(0.4321);
        $offer->setLocation(0.1, 0.2);
        $offer->setTypeOfTransaction(Offer::BUY);

        // Check if offer is updated
        $testArray = [
            'id' => $offer->getId(),
            'owner' => $user->getId(),
            'beer' => $beer->getId(),
            'amount' => 5,
            'price' => 0.4321,
            'total' => 5 * 0.4321,
            'location' => [
                'x' => 0.1,
                'y' => 0.2,
            ],
            'type' => 'buy',
        ];
        self::assertSame($testArray, $offer->__toArray());
    }
}
