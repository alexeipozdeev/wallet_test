<?php

namespace WalletApp\Service\WalletHistory;

use WalletApp\Repository\WalletHistory\WalletHistoryRepositoryInterface;

class WalletHistoryService implements WalletHistoryServiceInterface
{
    /**
     * @var WalletHistoryRepositoryInterface
     */
    private $walletHistoryRepository;

    /**
     * @param WalletHistoryRepositoryInterface $walletHistoryRepository
     */
    public function __construct(WalletHistoryRepositoryInterface $walletHistoryRepository)
    {
        $this->walletHistoryRepository = $walletHistoryRepository;
    }

    /**
     * @param int $numberDays
     * @param int $transaction_type_id
     * @return float
     */
    public function getTotalSumByNumberDaysByTypeTransactionId(int $numberDays, int $transaction_type_id): float
    {
        //$this->walletHistoryRepository
        $sum = 100;
        return round($sum, 2);
    }
}