<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id');
            $table->string('organization_type');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('ref_link')->nullable();
            $table->decimal('rating', 5, 2)->nullable();
            $table->decimal('max_limit', 11, 2)->nullable();
            $table->decimal('income_max_limit', 11, 2)->nullable();
            $table->integer('grace_period')->nullable();
            $table->decimal('rate_in', 11, 2)->nullable();
            $table->decimal('rate_after', 11, 2)->nullable();
            $table->string('service')->nullable();
            $table->decimal('cash_back', 11, 2)->nullable();
            $table->decimal('loan', 11, 2)->nullable();
            $table->boolean('chip')->default(false);
            $table->boolean('pay_wave')->default(false);
            $table->boolean('visa')->default(false);
            $table->boolean('master_card')->default(false);
            //Addition  26/06/19

            $table->text('preview')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->string('currency')->nullable();
            $table->text('list_documents')->nullable();
            $table->text('terms_repayment')->nullable();
            $table->text('fines_penalties')->nullable();
            $table->text('insurance')->nullable();

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
        Schema::dropIfExists('credit_cards');
    }
}
