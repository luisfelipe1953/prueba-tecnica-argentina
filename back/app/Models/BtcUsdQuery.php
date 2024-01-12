<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtcUsdQuery extends Model
{
    use HasFactory;

    public $fillable = ['btc_amount', 'usd_amount', 'rate_btc_in_usd'];
}
