<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->nestedSet();
            $table->string('name');
            $table->longText('content');
            $table->string('slug')->unique();
            $table->string('status', 50);
            $table->timestamp('public_date')->nullable();
            $table->bigInteger('views')->default(0);
            $table->boolean('enable_faq')->default(0);
            $table->timestamps();

            //Index
            $table->index(['status']);

            //Foreign
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
