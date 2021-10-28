<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\History;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    public function testEntityGettersSetters(): void
    {
        $history = new History();
        self::assertNotNull($history->getId());
    }
}
