<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMfoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mfo_org', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();

            $table->string('name');
            $table->text('ref_link')->nullable();
            $table->text('ref_link_2')->nullable();

            $table->decimal('rating', 5, 2)->nullable();
            $table->decimal('first_credit', 11, 2)->nullable();
            $table->text('preview')->nullable();
            $table->text('free_credit_description')->nullable();
            $table->decimal('free_credit_bid', 11, 2)->nullable();
            $table->decimal('free_credit_amount', 11, 2)->nullable();

            $table->decimal('min_amount', 11, 2)->nullable();
            $table->decimal('max_amount', 11, 2)->nullable();

            $table->decimal('repeat_credit_bid', 11, 2)->nullable();

            $table->integer('min_term')->nullable();
            $table->integer('max_term')->nullable();

            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();

            $table->integer('time_review')->nullable();

            $table->boolean('receiving_method_card')->default(0);
            $table->boolean('receiving_method_cash')->default(0);

            $table->text('special_offer')->nullable();


            $table->string('web_site')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('work_time')->nullable();
            $table->string('nfs_license')->nullable();

            $table->timestamps();
        });

        Schema::create('mfo_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('organization_type');
            $table->bigInteger('organization_id');
            $table->string('slug')->unique();


            $table->string('name');
            $table->text('ref_link')->nullable();

            $table->decimal('rating', 5, 2)->nullable();
            $table->decimal('first_credit', 11, 2)->nullable();
            $table->text('preview')->nullable();
            $table->text('free_credit_description')->nullable();
            $table->decimal('free_credit_bid', 11, 2)->nullable();
            $table->decimal('free_credit_amount', 11, 2)->nullable();

            $table->decimal('min_amount', 11, 2)->nullable();
            $table->decimal('max_amount', 11, 2)->nullable();

            $table->decimal('repeat_credit_bid', 11, 2)->nullable();

            $table->integer('min_term')->nullable();
            $table->integer('max_term')->nullable();

            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();

            $table->integer('time_review')->nullable();

            $table->boolean('receiving_method_card')->default(0);
            $table->boolean('receiving_method_cash')->default(0);

            $table->text('special_offer')->nullable();


            $table->string('web_site')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('work_time')->nullable();

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
        Schema::dropIfExists('mfo_org');

        Schema::dropIfExists('mfo_product');
    }
}
