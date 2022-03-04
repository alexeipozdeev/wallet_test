<?php

namespace WalletApp\Repository\Wallet;

use WalletApp\Entity\Wallet;

interface WalletRepositoryInterface
{
    /**
     * @param int $walletId
     * @return Wallet
     */
    public function getById(int $walletId): Wallet;

    /**
     * @return Wallet[]
     */
    public function getAll(): array;

    /**
     * @param Wallet $wallet
     * @return mixed
     */
    public function save(Wallet $wallet): void;
}