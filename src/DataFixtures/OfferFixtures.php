<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nyholm\NSA;

class OfferFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $offer = new Offer();
        NSA::setProperty($offer, 'id', '00000000-0000-0000-0000-000000000001');
        $manager->persist($offer);

        $manager->flush();
    }
}
