<?php

namespace WalletApp\Repository\WalletHistory;

use WalletApp\Entity\WalletHistory;

interface WalletHistoryRepositoryInterface
{
    /**
     * @param int $walletId
     * @return WalletHistory[]
     */
    public function getByWalletId(int $walletId): array;

    /**
     * @param WalletHistory $walletHistory
     * @return void
     */
    public function save(WalletHistory $walletHistory): void;
}