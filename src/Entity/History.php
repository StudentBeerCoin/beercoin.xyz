<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Offer $offer;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private User $counterparty;

    /**
     * @ORM\Column(type="integer")
     */
    private int $amount;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->getId(),
            'offer' => $this->getOffer()
                ->__toArray(),
            'counterparty' => $this->getCounterparty()
                ->__toArray(),
            'amount' => $this->getAmount(),
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): void
    {
        $this->offer = $offer;
    }

    public function getCounterparty(): User
    {
        return $this->counterparty;
    }

    public function setCounterparty(User $counterparty): void
    {
        $this->counterparty = $counterparty;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}
