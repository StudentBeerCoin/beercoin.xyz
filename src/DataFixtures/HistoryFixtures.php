<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\History;
use App\Entity\Offer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Nyholm\NSA;

class HistoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [UserFixtures::class, OfferFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $user = $this->referenceRepository->getReference('user2');
        assert($user instanceof User);

        $offer = $this->referenceRepository->getReference('offer');
        assert($offer instanceof Offer);

        $history = new History();
        NSA::setProperty($history, 'id', '00000000-0000-0000-0000-000000000001');
        $history->setOffer($offer);
        $history->setCounterparty($user);
        $history->setAmount(2);

        $manager->persist($history);
        $manager->flush();
    }
}
