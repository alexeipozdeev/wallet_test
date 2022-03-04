<?php

namespace WalletApp\Validation\RequestValidators;

use Symfony\Component\Validator\Constraints as Assert;
use WalletApp\Api\UpdateWalletRequest;

class UpdateWalletRequestValidator
{
    /**
     * @var float
     * @Assert\Type("float")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\NotEqualTo(0)
     */
    private $amount;

    /**
     * @var int
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\NotEqualTo(0)
     */
    private $currency_id;

    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\Choice("debit", "credit")
     */
    private $type_transaction_code;

    /**
     * @var int
     * @Assert\Type("string")
     * @Assert\Choice("stock", "refund")
     */
    private $reason_code;

    /**
     * @param UpdateWalletRequest $updateWalletRequest
     */
    public function __construct(UpdateWalletRequest $updateWalletRequest)
    {
        $this->amount = $updateWalletRequest->getAmount();
        $this->currency_id = $updateWalletRequest->getCurrencyId();
        $this->type_transaction_code = $updateWalletRequest->getTypeTransactionCode();
        $this->reason_code = $updateWalletRequest->getReasonCode();
    }
}
