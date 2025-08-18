<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('harga_pasar_items', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('nama');
            $table->integer('harga_kg');
            $table->enum('kondisi', ['naik', 'stabil', 'turun']);
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga_pasar_items');
    }
};
