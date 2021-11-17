<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    public const BUY = true;

    public const SELL = false;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Beer::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private Beer $beer;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(0)
     */
    private int $amount;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\Column(type="float")
     */
    private float $locationX;

    /**
     * @ORM\Column(type="float")
     */
    private float $locationY;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $typeOfTransaction;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->amount = 1;
        $this->locationX = 50.0687252;
        $this->locationY = 19.9066193;
        $this->typeOfTransaction = self::SELL;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->getId(),
            'owner' => $this->getOwner()
                ->getId(),
            'beer' => $this->getBeer()
                ->getId(),
            'amount' => $this->getAmount(),
            'price' => $this->getPrice(),
            'total' => $this->getAmount() * $this->getPrice(),
            'location' => [
                'x' => $this->getLocationX(),
                'y' => $this->getLocationY(),
            ],
            'type' => $this->isBuying() ? 'buy' : 'sell',
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    public function getBeer(): Beer
    {
        return $this->beer;
    }

    public function setBeer(Beer $beer): void
    {
        $this->beer = $beer;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getLocationX(): ?float
    {
        return $this->locationX;
    }

    public function setLocationX(float $locationX): void
    {
        $this->locationX = $locationX;
    }

    public function getLocationY(): ?float
    {
        return $this->locationY;
    }

    public function setLocationY(float $locationY): void
    {
        $this->locationY = $locationY;
    }

    public function getLocation(): array
    {
        return [$this->getLocationX(), $this->getLocationY()];
    }

    public function setLocation(?float $x = null, ?float $y = null): void
    {
        if ($x) {
            $this->setLocationX($x);
        }

        if ($y) {
            $this->setLocationY($y);
        }
    }

    public function isSelling(): bool
    {
        return $this->typeOfTransaction === self::SELL;
    }

    public function isBuying(): bool
    {
        return $this->typeOfTransaction === self::BUY;
    }

    public function setTypeOfTransaction(bool $typeOfTransaction): void
    {
        $this->typeOfTransaction = $typeOfTransaction;
    }
}
