<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('like_logs', function (Blueprint $table) {
            //$table->increments('id');

            $table->integer('info_id')->unsigned();
            $table->foreign('info_id')->references('id')->on('infos');
            $table->integer('voter_id')->unsigned();
            $table->foreign('voter_id')->references('id')->on('wechat_users');
            $table->primary(['info_id', 'voter_id']);
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('like_logs');
    }
}
