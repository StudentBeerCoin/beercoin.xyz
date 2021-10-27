<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Beer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nyholm\NSA;

class BeerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $beer = new Beer();
        NSA::setProperty($beer, 'id', '00000000-0000-0000-0000-000000000001');
        $manager->persist($beer);

        $manager->flush();
    }
}
