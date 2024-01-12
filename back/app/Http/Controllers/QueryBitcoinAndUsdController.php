<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Contracts\BtcUsdRepositoryInterface;
use App\Http\Requests\QueryBitcoinToUsdRequest;
use App\Http\Requests\QueryUsdToBitcoinRequest;
use App\Services\JsonResponseService;

class QueryBitcoinAndUsdController extends Controller
{
    public function __construct(
        protected readonly BtcUsdRepositoryInterface $bitcoinRepository,
        protected readonly JsonResponseService $response,
    ) {
    }

    public function QueryDollarToBitcoin(QueryUsdToBitcoinRequest $request): float | JsonResponse
    {
        try {
            $usdAmount = $request->usd_amount;
            return $this->bitcoinRepository->convertUsdToBitcoin($usdAmount);
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }

    public function QueryBitcoinToDollar(QueryBitcoinToUsdRequest $request): float | JsonResponse
    {
        try {
            $btcAmount = $request->btc_amount;
            return $this->bitcoinRepository->convertBitcoinToUsd($btcAmount);
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}
