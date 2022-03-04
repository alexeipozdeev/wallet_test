<?php

namespace WalletApp\Api;

class UpdateWalletRequest
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var int
     */
    private $currency_id;

    /**
     * @var string
     */
    private $type_transaction_code;

    /**
     * @var string
     */
    private $reason_code;

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