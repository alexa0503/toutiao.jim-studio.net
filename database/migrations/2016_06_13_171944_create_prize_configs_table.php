<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizeConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prize_configs', function (Blueprint $table) {
                $table->increments('id');
                $table->date('lottery_date')->index();
                $table->integer('prize_id')->unsigned()->index();
                $table->foreign('prize_id')->references('id')->on('prizes');
                $table->integer('prize_num')->index();
                $table->integer('win_num')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prize_configs');
    }
}
