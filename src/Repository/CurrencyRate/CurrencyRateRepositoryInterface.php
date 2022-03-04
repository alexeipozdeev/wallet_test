<?php

namespace WalletApp\Repository\CurrencyRate;

interface CurrencyRateRepositoryInterface
{
    /**
     * @param int $fromCurrencyId
     * @param int $toCurrencyId
     * @return float
     */
    public function getRateByCurrenciesPair(int $fromCurrencyId, int $toCurrencyId): float;
}