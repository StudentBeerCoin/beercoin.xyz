<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\History;
use App\Entity\Offer;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    public function testEntityGettersSetters(): void
    {
        $user = new User();
        $offer = new Offer();

        $history = new History();

        // Check defaults
        self::assertNotNull($history->getId());

        // Set custom history properties
        $history->setOffer($offer);
        $history->setCounterparty($user);
        $history->setAmount(2);

        // Check if history is updated
        self::assertSame($offer, $history->getOffer());
        self::assertSame($user, $history->getCounterparty());
        self::assertSame(2, $history->getAmount());
    }
}
