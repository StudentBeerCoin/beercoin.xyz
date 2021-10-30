<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\Offer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Nyholm\NSA;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [UserFixtures::class, BeerFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $user = $this->referenceRepository->getReference('user');
        assert($user instanceof User);

        $beer = $this->referenceRepository->getReference('beer');
        assert($beer instanceof Beer);

        $offer = new Offer();
        NSA::setProperty($offer, 'id', '00000000-0000-0000-0000-000000000001');
        $offer->setOwner($user);
        $offer->setBeer($beer);
        $offer->setAmount(5);
        $offer->setPrice(0.4672);
        $this->setReference('offer', $offer);

        $manager->persist($offer);
        $manager->flush();
    }
}
