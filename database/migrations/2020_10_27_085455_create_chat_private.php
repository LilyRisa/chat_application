<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatPrivate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_private', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_send')->unsigned();
            $table->bigInteger('user_recv')->unsigned();
            $table->longText('messenges');
            $table->boolean('seem');
            $table->foreign('user_send')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_recv')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('chat_private');
    }
}
