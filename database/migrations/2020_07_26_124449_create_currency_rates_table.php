<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api', 50);
            $table->string('txt', 50);
            $table->string('cc', 5);
            $table->string('exchangedate', 12);
            $table->decimal('old_rate_buy', 15, 10);
            $table->decimal('old_rate_sale', 15, 10);
            $table->decimal('new_rate_buy', 15, 10);
            $table->decimal('new_rate_sale', 15, 10);
            $table->integer('ordered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_rates');
    }
}
