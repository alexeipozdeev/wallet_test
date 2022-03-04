<?php

namespace WalletApp\Service\WalletHistory;

interface WalletHistoryServiceInterface
{
    /**
     * @param int $numberDays
     * @param int $transaction_type_id
     * @return float
     */
    public function getTotalSumByNumberDaysByTypeTransactionId(int $numberDays, int $transaction_type_id): float;
}