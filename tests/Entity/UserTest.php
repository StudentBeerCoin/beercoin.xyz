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

        // Set custom user properties
        $user->setUsername('t_username');
        $user->setName('t_name');
        $user->setSurname('t_surname');
        $user->setEmail('test@example.com');
        $user->setPhoneNumber('123123123');
        $user->setBalance(1.23456789);
        $user->setPassword('t_password');
        $user->setLocation(0.1, 0.2);

        // Check if user is updated
        $testArray = [
            'id' => $user->getId(),
            'username' => 't_username',
            'name' => 't_name',
            'surname' => 't_surname',
            'email' => 'test@example.com',
            'phoneNumber' => '123123123',
            'balance' => 1.23456789,
            'location' => [
                'x' => 0.1,
                'y' => 0.2,
            ],
        ];
        self::assertSame($testArray, $user->__toArray());
        self::assertTrue($user->isPasswordValid('t_password'));
    }
}
