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
        self::assertNotNull($beer->getId());
    }
}
