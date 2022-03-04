<?php


namespace WalletApp\Controller;

use DateTime;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;
use WalletApp\Api\UpdateWalletRequest;
use WalletApp\Entity\Wallet;
use WalletApp\Entity\WalletHistory;
use WalletApp\Repository\Wallet\WalletRepositoryInterface;
use WalletApp\Repository\WalletHistory\WalletHistoryRepositoryInterface;
use WalletApp\Service\CurrencyRate\CurrencyRateServiceInterface;
use WalletApp\Service\WalletHistory\WalletHistoryServiceInterface;
use WalletApp\Validation\RequestValidators\UpdateWalletRequestValidator;

class WalletController
{
    /**
     * @var WalletRepositoryInterface
     */
    private $walletRepository;

    /**
    * @var WalletHistoryRepositoryInterface
    */
    private $walletHistoryRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var CurrencyRateServiceInterface
     */
    private $currencyRateService;

    /**
     * @var WalletHistoryServiceInterface
     */
    private $walletHistoryService;

    /**
     * @param WalletRepositoryInterface $walletRepository
     * @param WalletHistoryRepositoryInterface $walletHistoryRepository
     */
    public function __construct(
        ValidatorInterface $validator,
        WalletRepositoryInterface $walletRepository,
        WalletHistoryRepositoryInterface $walletHistoryRepository,
        WalletHistoryServiceInterface $walletHistoryService,
        CurrencyRateServiceInterface $currencyRateService
    )
    {
        $this->walletRepository = $walletRepository;
        $this->walletHistoryRepository = $walletHistoryRepository;
        $this->validator = $validator;
        $this->currencyRateService = $currencyRateService;
        $this->walletHistoryService = $walletHistoryService;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        try {
            $wallet = $this->walletRepository->getById($id);

            return new JsonResponse($this->getAsArray($wallet),Response::HTTP_OK);
        } catch (Throwable $exception) {
            return new JsonResponse(
                [
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function change(int $id): JsonResponse
    {
        try {
            $updateWalletRequest = $this->getUpdateWalletRequest();

            $requestValidator = new UpdateWalletRequestValidator($updateWalletRequest);
            $error = $this->validator->validate($requestValidator);
            if (count($error) > 0) {
                /** @var ConstraintViolationInterface $violation */
                $violation = $error[0];

                return new JsonResponse(
                    [
                        'success' => false,
                        'error' => "{$violation->getPropertyPath()} - {$violation->getMessage()}",
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $wallet = $this->walletRepository->getById($id);

            $convertedAmount = $this->convertAmount(
                $updateWalletRequest->getAmount(),
                $updateWalletRequest->getCurrencyId(),
                $wallet->getCurrencyId()
            );

            $this->changeBalance($wallet, $convertedAmount);
            $this->saveHistoryAboutChanges($wallet, $convertedAmount, $updateWalletRequest);

            return new JsonResponse(['success' => true],Response::HTTP_OK);
        } catch (Throwable $exception) {
            return new JsonResponse(
                [
                    'success' => false,
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @return JsonResponse
     */
    public function getTotalSumByNumberDays(): JsonResponse
    {
        try {
            return new JsonResponse(
                [
                    'total_sum' => $this->walletHistoryService->getTotalSumByNumberDaysByTypeTransactionId(7, 1)
                ],
            Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new JsonResponse(
                [
                    'success' => false,
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @return UpdateWalletRequest
     */
    private function getUpdateWalletRequest(): UpdateWalletRequest
    {
        $request = new Request();
        $data = json_decode($request->getContent(), true);

        $updateWalletRequest = new UpdateWalletRequest();
        $updateWalletRequest->setTypeTransactionCode((string) $data['type_transaction_code']);
        $updateWalletRequest->setAmount((float) $data['amount']);
        $updateWalletRequest->setCurrencyId((int) $data['currency_id']);
        $updateWalletRequest->setReasonCode((string) $data['reason_code']);

        return $updateWalletRequest;
    }

    /**
     * @param Wallet $wallet
     * @param float $convertedAmount
     * @param UpdateWalletRequest $updateWalletRequest
     * @return void
     */
    private function saveHistoryAboutChanges(Wallet $wallet, float $convertedAmount, UpdateWalletRequest $updateWalletRequest): void
    {
        $walletHistory = new WalletHistory();
        $walletHistory->setWalletId($wallet->getId());
        $walletHistory->setTypeTransactionCode($updateWalletRequest->getTypeTransactionCode());
        $walletHistory->setAmount($convertedAmount);
        $walletHistory->setCurrencyId($wallet->getCurrencyId());
        $walletHistory->setCreated(new DateTime());
        $walletHistory->setReasonCode($updateWalletRequest->getReasonCode());

        $this->walletHistoryRepository->save($walletHistory);
    }

    /**
     * @param Wallet $wallet
     * @param float $convertedAmount
     * @return void
     */
    private function changeBalance(Wallet $wallet, float $convertedAmount): void
    {
        $balance = $wallet->getBalance();

        $balance += $convertedAmount;
        if ($balance < 0) {
            throw new RuntimeException('Insufficient funds');
        }

        $wallet->setBalance($balance);

        $this->walletRepository->save($wallet);
    }

    /**
     * @param float $amount
     * @param int $fromCurrencyId
     * @param int $toCurrencyId
     * @return float
     */
    private function convertAmount(float $amount, int $fromCurrencyId, int $toCurrencyId): float
    {
        if ($fromCurrencyId === $toCurrencyId) {
            return $amount;
        }

        return $this->currencyRateService->convert($amount, $fromCurrencyId, $toCurrencyId);
    }

    /**
     * @param Wallet $wallet
     * @return array
     */
    private function getAsArray(Wallet $wallet): array
    {
        return [
            'id' => $wallet->getId(),
            'client_id' => $wallet->getClientId(),
            'balance' => $wallet->getBalance(),
            'currency_id' => $wallet->getCurrencyId(),
        ];
    }
}