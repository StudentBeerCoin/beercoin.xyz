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
        self::assertNotNull($offer->getId());
    }
}
