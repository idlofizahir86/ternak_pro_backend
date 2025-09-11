<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('t_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('iconPath');
            $table->string('user_id')->nullable();
            $table->foreign('user_id')->references('uid')->on('users')->onDelete('cascade');
            $table->boolean('is_aktif')->default(false);  // is_aktif kolom baru dengan default true
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_notifications');
    }
}
