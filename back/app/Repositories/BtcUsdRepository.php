<?php

namespace App\Repositories;

use App\Contracts\BtcUsdRepositoryInterface;
use GuzzleHttp\Client as Http;
use App\Models\BtcUsdQuery;
use App\Repositories\BaseRepository;

class BtcUsdRepository extends BaseRepository implements BtcUsdRepositoryInterface
{
    public $model;
    protected $apiUrl;

    public function __construct(BtcUsdQuery $model)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->apiUrl = env('API_URL');
    }

    /**
     * convierte de dolar a bitcoin
     */
    public function convertUsdToBitcoin(float $usdAmount): float
    {
        $priceUSD = $this->getBitcoinPrice();
        
        $result = $usdAmount / ($priceUSD * 0.00000001) / 100000000;

        $this->storeQuery($usdAmount, $result, $priceUSD);

        return $result;
    }

    /**
     * convierte de bitcoin a dolar
     */
    public function convertBitcoinToUsd(float $btcAmount): float
    {
        $priceUSD = $this->getBitcoinPrice();
        $result = $priceUSD * $btcAmount;

        $this->storeQuery($btcAmount, $result, $priceUSD);

        return $result;
    }

    /**
     * obtiene el precio del bitcoin en dolares
     */
    public function getBitcoinPrice(): float
    {
        $http = new Http();
        $response = $http->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);

        return $data['bpi']['USD']['rate_float'];
    }

    /**
     * guarda la consulta
     */
    protected function storeQuery(float $amount, float $result, float $rate)
    {
        $array = new BtcUsdQuery([
            'btc_amount' => $result,
            'usd_amount' => $amount,
            'rate_btc_in_usd' => $rate,
        ]);

        $this->save($array);
    }
}
