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
        self::assertNotNull($user->getId());
    }
}
