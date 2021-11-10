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

        // Set custom beer parameters
        $beer->setBrand('t_brand');
        $beer->setName('t_name');
        $beer->setVolume(450);
        $beer->setAlcohol(6);
        $beer->setPacking(Beer::BOTTLE);

        // Check if beer is updated
//        self::assertSame('t_brand', $beer->getBrand());
//        self::assertSame('t_name', $beer->getName());
//        self::assertSame(450, $beer->getVolume());
//        self::assertSame(6.0, $beer->getAlcohol());
//        self::assertTrue($beer->isBottle());
//        self::assertFalse($beer->isCan());

        $testArray = [
            'id' => $beer->getId(),
            'brand' => 't_brand',
            'name' => 't_name',
            'volume' => 450,
            'alcohol' => 6.0,
            'packing' => 'bottle',
        ];
        self::assertSame($testArray, $beer->__toArray());
    }
}
