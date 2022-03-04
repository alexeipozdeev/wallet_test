<?php

namespace WalletApp\Repository\WalletHistory;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use WalletApp\Entity\WalletHistory;

class WalletHistoryRepository extends EntityRepository implements WalletHistoryRepositoryInterface
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(WalletHistory::class));
    }

    /**
     * @param int $walletId
     * @return WalletHistory[]
     */
    public function getByWalletId(int $walletId): array
    {
        return $this->findBy(['wallet_id' => $walletId], ['currency_id' => 'ASC']);
    }

    /**
     * @param WalletHistory $walletHistory
     * @return void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(WalletHistory $walletHistory): void
    {
        $this->_em->persist($walletHistory);
        $this->_em->flush($walletHistory);
    }
}