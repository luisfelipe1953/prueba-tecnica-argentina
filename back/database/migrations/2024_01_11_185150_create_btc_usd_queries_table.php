<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('btc_usd_queries', function (Blueprint $table) {
            $table->id();
            $table->string('btc_amount');
            $table->string('usd_amount');
            $table->decimal('rate_btc_in_usd', 16, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('btc_usd_queries');
    }
};
