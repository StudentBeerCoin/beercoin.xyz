<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nyholm\NSA;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        NSA::setProperty($user, 'id', '00000000-0000-0000-0000-000000000001');
        $manager->persist($user);

        $manager->flush();
    }
}
