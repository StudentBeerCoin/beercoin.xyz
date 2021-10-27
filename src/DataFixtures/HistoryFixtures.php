<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\History;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nyholm\NSA;

class HistoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $history = new History();
        NSA::setProperty($history, 'id', '00000000-0000-0000-0000-000000000001');
        $manager->persist($history);

        $manager->flush();
    }
}
