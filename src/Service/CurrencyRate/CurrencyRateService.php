<?php

namespace WalletApp\Service\CurrencyRate;

use WalletApp\Repository\CurrencyRate\CurrencyRateRepositoryInterface;

class CurrencyRateService implements CurrencyRateServiceInterface
{
    /**
     * @var CurrencyRateRepositoryInterface
     */
    private $currencyRateRepository;

    public function __construct(CurrencyRateRepositoryInterface $currencyRateRepository)
    {
        $this->currencyRateRepository = $currencyRateRepository;
    }

    /**
     * @param float $amount
     * @param int $fromCurrencyId
     * @param int $toCurrencyId
     * @return float
     */
    public function convert(float $amount, int $fromCurrencyId, int $toCurrencyId): float
    {
        $currencyRate = $this->currencyRateRepository->getRateByCurrenciesPair($fromCurrencyId, $toCurrencyId);

        return round($amount * $currencyRate, 2);
    }
}