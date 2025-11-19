<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seoeable_id')->unsigned();
            $table->string('seoeable_type');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('canonical')->nullable();
            $table->string('robot_index')->nullable();
            $table->string('robot_follow')->nullable();
            $table->string('amp_html')->nullable();
            $table->timestamps();
        });

        Schema::create('seo_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seo_id')->unsigned();
            $table->string('meta_key');
            $table->text('meta_value')->nullable();

            //Foreign
            $table->foreign('seo_id')
                ->references('id')->on('seos')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_meta');

        Schema::dropIfExists('seos');
    }
}
