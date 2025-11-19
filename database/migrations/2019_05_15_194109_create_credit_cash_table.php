<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cash', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id');
            $table->string('organization_type');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('ref_link')->nullable();
            $table->decimal('rating', 5, 2)->nullable();
            $table->decimal('min_amount', 11, 2)->nullable();
            $table->decimal('max_amount', 11, 2)->nullable();
            $table->decimal('income_max_amount', 11, 2)->nullable();
            $table->integer('min_term')->nullable();
            $table->integer('max_term')->nullable();
            $table->decimal('percent_new_individual', 8, 2)->nullable();
            $table->decimal('percent_new_legal', 8, 2)->nullable();
            $table->decimal('percent_client', 8, 2)->nullable();
            $table->text('docs_individual')->nullable();
            $table->text('docs_legal')->nullable();
            $table->text('experience')->nullable();

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
        Schema::dropIfExists('credit_cash');
    }
}
