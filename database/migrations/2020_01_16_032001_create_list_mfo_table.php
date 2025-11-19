<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListMfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_mfo', function (Blueprint $table) {
            $table->bigIncrements('uid');
            $table->bigInteger('list_id')->unsigned();
            $table->bigInteger('mfo_id')->unsigned();
            $table->integer('sort')->default(0);

            //Foreign
            $table->foreign('list_id')
                ->references('id')->on('lists')
                ->onDelete('cascade');

            $table->foreign('mfo_id')
                ->references('id')->on('mfo_org')
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
        Schema::dropIfExists('list_mfo');
    }
}
