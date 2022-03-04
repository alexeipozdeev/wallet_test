<?php

namespace WalletApp\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @package WalletApp\Entity
 *
 * @ORM\Entity(repositoryClass="WalletApp\Repository\WalletHistory\WalletHistoryRepository")
 * @ORM\Table(name="wallet_history")
 */
class WalletHistory
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
     * @ORM\Column(name="wallet_id", type="integer", nullable=false)
     *
     * @var int
     */
    private $wallet_id;

    /**
     * @ORM\Column(name="type_transaction_code", type="string", nullable=false)
     *
     * @var string
     */
    private $type_transaction_code;

    /**
     * @ORM\Column(name="amount", type="decimal", nullable=false)
     *
     * @var double
     */
    private $amount;

    /**
     * @ORM\Column(name="currency_id", type="integer", nullable=false)
     *
     * @var int
     */
    private $currency_id;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     *
     * @var DateTime
     */
    private $created;

    /**
     * @ORM\Column(name="reason_code", type="string", nullable=false)
     *
     * @var string
     */
    private $reason_code;

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
    public function getWalletId(): int
    {
        return $this->wallet_id;
    }

    /**
     * @param int $wallet_id
     */
    public function setWalletId(int $wallet_id): void
    {
        $this->wallet_id = $wallet_id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
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
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getTypeTransactionCode(): string
    {
        return $this->type_transaction_code;
    }

    /**
     * @param string $type_transaction_code
     */
    public function setTypeTransactionCode(string $type_transaction_code): void
    {
        $this->type_transaction_code = $type_transaction_code;
    }

    /**
     * @return string
     */
    public function getReasonCode(): string
    {
        return $this->reason_code;
    }

    /**
     * @param string $reason_code
     */
    public function setReasonCode(string $reason_code): void
    {
        $this->reason_code = $reason_code;
    }
}
