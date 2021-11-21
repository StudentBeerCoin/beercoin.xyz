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
        self::assertSame(50.068785, $user->getLocationX());
        self::assertSame(19.906250, $user->getLocationY());
        self::assertSame([$user->getLocationX(), $user->getLocationY()], $user->getLocation());

        // Set custom user password
        $user->setPassword('t_password');
        self::assertTrue($user->isPasswordValid('t_password'));
    }
}
