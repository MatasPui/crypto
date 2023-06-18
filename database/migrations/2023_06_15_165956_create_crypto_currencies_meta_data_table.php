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
        Schema::create('crypto_currencies_meta_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crypto_currency_id')->constrained('crypto_currencies')->onDelete('cascade');
            $table->string('symbol');
            $table->string('slug');
            $table->integer('cmc_rank');
            $table->bigInteger('circulating_supply');
            $table->bigInteger('total_supply');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->date('date_added')->nullable();
            $table->date('date_launched')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_currency_meta_data');
    }
};
