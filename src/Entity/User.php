<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message="Podany email ({{ value }}) jest nieprawidłowy",
     *     mode="strict"
     * )
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private string $phoneNumber;

    /**
     * @ORM\Column(type="float")
     */
    private float $balance;

    /**
     * @ORM\Column(type="float")
     */
    private float $locationX;

    /**
     * @ORM\Column(type="float")
     */
    private float $locationY;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->balance = 0;
        $this->locationX = 50.068785;
        $this->locationY = 19.906250;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'phoneNumber' => $this->getPhoneNumber(),
            'balance' => $this->getBalance(),
            'location' => [
                'x' => $this->getLocationX(),
                'y' => $this->getLocationY(),
            ],
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    public function getLocationX(): float
    {
        return $this->locationX;
    }

    public function setLocationX(float $x): void
    {
        $this->locationX = $x;
    }

    public function getLocationY(): float
    {
        return $this->locationY;
    }

    public function setLocationY(float $y): void
    {
        $this->locationY = $y;
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
}
