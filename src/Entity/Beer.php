<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BeerRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=BeerRepository::class)
 */
class Beer
{
    public const CAN = true;

    public const BOTTLE = false;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $volume;

    /**
     * @ORM\Column(type="float")
     */
    private float $alcohol;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $packing;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->volume = 500;
        $this->alcohol = 4.5;
        $this->packing = true;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): void
    {
        $this->volume = $volume;
    }

    public function getAlcohol(): ?float
    {
        return $this->alcohol;
    }

    public function setAlcohol(float $alcohol): void
    {
        $this->alcohol = $alcohol;
    }

    public function isCan(): bool
    {
        return $this->packing === self::CAN;
    }

    public function isBottle(): bool
    {
        return $this->packing === self::BOTTLE;
    }

    public function setPacking(bool $packing): void
    {
        $this->packing = $packing;
    }
}
