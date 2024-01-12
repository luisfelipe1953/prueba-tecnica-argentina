<?php 

namespace App\Contracts;

interface BtcUsdRepositoryInterface
{
    public function convertUsdToBitcoin(float $usdAmount): float;
 
    public function convertBitcoinToUsd(float $btcAmount): float;
}