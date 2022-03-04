<?php

namespace WalletApp\Repository\Wallet;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use RuntimeException;
use WalletApp\Entity\Wallet;

class WalletRepository extends EntityRepository implements WalletRepositoryInterface
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Wallet::class));
    }

    /**
     * @param int $walletId
     * @return Wallet
     */
    public function getById(int $walletId): Wallet
    {
        /**
         * @var Wallet $walletId
         */
        $wallet = $this->findOneBy(['id' => $walletId]);
        if ($wallet === null) {
            throw new RuntimeException("Can not find the wallet by id {$walletId}");
        }

        return $wallet;
    }

    /**
     * @return Wallet[]
     */
    public function getAll(): array
    {
        return $this->findBy([], ['currency_id' => 'ASC']);
    }

    /**
     * @param Wallet $wallet
     * @return void
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Wallet $wallet): void
    {
        $this->_em->persist($wallet);
        $this->_em->flush($wallet);
    }
}