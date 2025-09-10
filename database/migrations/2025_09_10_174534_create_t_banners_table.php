<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_banners', function (Blueprint $table) {
            $table->id();  // id Primary, AUTO_INCREMENT
            $table->string('title', 255)->nullable()->default(null);  // title
            $table->string('bannerUrl', 250)->nullable()->default(null);  // bannerUrl
            $table->boolean('is_aktif')->default(false);  // is_aktif kolom baru dengan default true
            $table->timestamps(0);  // created_at and updated_at with current timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_banners');
    }
}
