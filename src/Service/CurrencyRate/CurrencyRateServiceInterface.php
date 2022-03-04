<?php

namespace WalletApp\Service\CurrencyRate;

interface CurrencyRateServiceInterface
{
    /**
     * @param float $amount
     * @param int $fromCurrencyId
     * @param int $toCurrencyId
     * @return float
     */
    public function convert(float $amount, int $fromCurrencyId, int $toCurrencyId ): float;
}