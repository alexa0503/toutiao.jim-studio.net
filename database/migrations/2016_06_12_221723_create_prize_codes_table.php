<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizeCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prize_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prize_id')->unsigned()->index();
            $table->foreign('prize_id')->references('id')->on('prizes');
            $table->string('code',60);
            $table->boolean('is_active')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prize_codes');
    }
}
