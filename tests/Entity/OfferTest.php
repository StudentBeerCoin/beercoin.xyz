<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Offer;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    public function testEntityGettersSetters(): void
    {
        $offer = new Offer();

        // Check defaults
        self::assertNotNull($offer->getId());
        self::assertSame(1, $offer->getAmount());
        self::assertSame(50.0687252, $offer->getLocationX());
        self::assertSame(19.9066193, $offer->getLocationY());
        self::assertSame([$offer->getLocationX(), $offer->getLocationY()], $offer->getLocation());
        self::assertTrue($offer->isSelling());
        self::assertFalse($offer->isBuying());
    }
}
