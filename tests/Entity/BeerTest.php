<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Beer;
use PHPUnit\Framework\TestCase;

class BeerTest extends TestCase
{
    public function testEntityGettersSetters(): void
    {
        $beer = new Beer();

        // Check defaults
        self::assertNotNull($beer->getId());
        self::assertSame(500, $beer->getVolume());
        self::assertSame(4.5, $beer->getAlcohol());
        self::assertTrue($beer->isCan());
        self::assertFalse($beer->isBottle());
    }
}
