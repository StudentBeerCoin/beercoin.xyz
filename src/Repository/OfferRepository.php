<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Offer;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    /**
     * @return Offer[]
     */
    public function findAllBuy(): array
    {
        return $this->createQueryBuilder('o')
            ->where('o.typeOfTransaction = :transaction')
            ->setParameter('transaction', Offer::BUY)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Offer[]
     */
    public function findAllSell(): array
    {
        return $this->createQueryBuilder('o')
            ->where('o.typeOfTransaction = :transaction')
            ->setParameter('transaction', Offer::SELL)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Offer[]
     */
    public function findAllByUser(User $user): array
    {
        return $this->createQueryBuilder('o')
            ->where('o.owner = :owner')
            ->setParameter('offer', $user->getId())
            ->getQuery()
            ->getResult();
    }
}
