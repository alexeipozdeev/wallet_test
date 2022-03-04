<?php

namespace WalletApp\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package WalletApp\Entity
 *
 * @ORM\Entity(repositoryClass="WalletApp\Repository\CurrencyRate\CurrencyRateRepository")
 * @ORM\Table(name="currency_rate")
 */
class CurrencyRate
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="from_currency_id", type="integer", nullable=false)
     *
     * @var int
     */
    private $from_currency_id;

    /**
     * @ORM\Column(name="to_currency_id", type="integer", nullable=false)
     *
     * @var int
     */
    private $to_currency_id;

    /**
     * @ORM\Column(name="rate", type="integer", nullable=false)
     *
     * @var int
     */
    private $rate;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     *
     * @var string
     */
    private $created;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getFromCurrencyId(): int
    {
        return $this->from_currency_id;
    }

    /**
     * @param int $from_currency_id
     */
    public function setFromCurrencyId(int $from_currency_id): void
    {
        $this->from_currency_id = $from_currency_id;
    }

    /**
     * @return int
     */
    public function getToCurrencyId(): int
    {
        return $this->to_currency_id;
    }

    /**
     * @param int $to_currency_id
     */
    public function setToCurrencyId(int $to_currency_id): void
    {
        $this->to_currency_id = $to_currency_id;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @param int $rate
     */
    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated(string $created): void
    {
        $this->created = $created;
    }
}
