<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testEntityGettersSetters(): void
    {
        $user = new User();

        // Check defaults
        self::assertNotNull($user->getId());
        self::assertSame(0.0, $user->getBalance());
        self::assertSame(50.0687252, $user->getLocationX());
        self::assertSame(19.9066193, $user->getLocationY());
        self::assertSame([$user->getLocationX(), $user->getLocationY()], $user->getLocation());

        // Set custom user properties
        $user->setUsername('t_username');
        $user->setName('t_name');
        $user->setSurname('t_surname');
        $user->setEmail('test@example.com');
        $user->setPhoneNumber('123123123');
        $user->setBalance(1.23456789);
        $user->setLocation(0.1, 0.2);

        // Check if user is updated
        self::assertSame('t_username', $user->getUsername());
        self::assertSame('t_name', $user->getName());
        self::assertSame('t_surname', $user->getSurname());
        self::assertSame('test@example.com', $user->getEmail());
        self::assertSame('123123123', $user->getPhoneNumber());
        self::assertSame(1.23456789, $user->getBalance());
        self::assertSame([0.1, 0.2], $user->getLocation());
    }
}
