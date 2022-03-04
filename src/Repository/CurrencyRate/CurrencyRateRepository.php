<?php

namespace WalletApp\Repository\CurrencyRate;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RuntimeException;
use WalletApp\Entity\CurrencyRate;

class CurrencyRateRepository extends EntityRepository implements CurrencyRateRepositoryInterface
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(CurrencyRate::class));
    }

    /**
     * @param int $fromCurrencyId
     * @param int $toCurrencyId
     * @return float
     */
    public function getRateByCurrenciesPair(int $fromCurrencyId, int $toCurrencyId): float
    {
        /**
         * @var CurrencyRate $currencyRate
         */
        $currencyRate = $this->findOneBy(
            [
                'from_currency_id' => $fromCurrencyId,
                'to_currency_id' => $toCurrencyId
            ],
            ['created' => 'DESC']
        );
        if ($currencyRate === null) {
            throw new RuntimeException("Can not find the currency rate by currency ids pair {$fromCurrencyId} - {$toCurrencyId}");
        }

        return $currencyRate->getRate();
    }
}