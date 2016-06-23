<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('id')->unique()->unsigned();
            $table->foreign('id')->references('id')->on('wechat_users');
            $table->string('title', 100);
            $table->string('image_path', 100);
            $table->integer('like_num')->index();
            $table->boolean('is_scan')->index();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('infos');
    }
}
