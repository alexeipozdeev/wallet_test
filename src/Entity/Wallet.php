<?php

namespace WalletApp\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package WalletApp\Entity
 *
 * @ORM\Entity(repositoryClass="WalletApp\Repository\Wallet\WalletRepository")
 * @ORM\Table(name="wallet")
 */
class Wallet
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
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     *
     * @var int
     */
    private $client_id;

    /**
     * @ORM\Column(name="balance", type="decimal", nullable=false)
     *
     * @var double
     */
    private $balance;

    /**
     * @ORM\Column(name="currency_id", type="integer", nullable=false)
     *
     * @var int
     */
    private $currency_id;

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
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getCurrencyId(): int
    {
        return $this->currency_id;
    }

    /**
     * @param int $currency_id
     */
    public function setCurrencyId(int $currency_id): void
    {
        $this->currency_id = $currency_id;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->client_id;
    }

    /**
     * @param int $client_id
     */
    public function setClientId(int $client_id): void
    {
        $this->client_id = $client_id;
    }
}
