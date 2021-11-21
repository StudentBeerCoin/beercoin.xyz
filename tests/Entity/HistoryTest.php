<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Beer;
use App\Entity\History;
use App\Entity\Offer;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    // This test is also checking __toArray() of all other entities.
    // It was necessary to create more objects here to test
    // History's _toArray().
    public function testEntityGettersSetters(): void
    {
        $user = new User();
        $user->setUsername('t_username');
        $user->setName('t_name');
        $user->setSurname('t_surname');
        $user->setEmail('test@example.com');
        $user->setPhoneNumber('123123123');
        $user->setBalance(1.23456789);
        $user->setPassword('t_password');
        $user->setLocation(0.1, 0.2);

        $beer = new Beer();
        $beer->setBrand('t_brand');
        $beer->setName('t_name');
        $beer->setVolume(450);
        $beer->setAlcohol(6);
        $beer->setPacking(Beer::BOTTLE);

        $offer = new Offer();
        $offer->setOwner($user);
        $offer->setBeer($beer);
        $offer->setAmount(5);
        $offer->setPrice(0.4321);
        $offer->setLocation(0.1, 0.2);
        $offer->setTypeOfTransaction(Offer::BUY);

        $history = new History();

        // Check defaults
        self::assertNotNull($history->getId());

        // Set custom history properties
        $history->setOffer($offer);
        $history->setCounterparty($user);
        $history->setAmount(2);

        // Check if history is updated
        $testArray = [
            'id' => $history->getId(),
            'offer' => $offer->__toArray(),
            'counterparty' => $user->__toArray(),
            'amount' => 2,
        ];
        self::assertSame($testArray, $history->__toArray());
    }
}
