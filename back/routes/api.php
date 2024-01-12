<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueryBitcoinAndUsdController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/query/usd-to-btc', [QueryBitcoinAndUsdController::class, 'QueryDollarToBitcoin']);
Route::post('/query/usd-to-btc', [QueryBitcoinAndUsdController::class, 'QueryDollarToBitcoin']);
Route::get('/price-bitcoin', [QueryBitcoinAndUsdController::class, 'getPriceBitcoin']);