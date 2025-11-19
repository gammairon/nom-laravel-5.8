<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('president_name')->nullable();
            $table->decimal('rating', 5, 2)->nullable();
            $table->string('mfo')->nullable();
            $table->string('swift')->nullable();
            $table->string('egrdpou')->nullable();
            $table->string('number_reg')->nullable();
            $table->timestamp('date_reg')->nullable();
            $table->string('number_license')->nullable();
            $table->timestamp('date_license')->nullable();
            $table->text('description')->nullable();
            $table->string('head_office')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('web_site')->nullable();
            $table->text('preview')->nullable();
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
        Schema::dropIfExists('banks');
    }
}
