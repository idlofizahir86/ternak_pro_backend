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
        Schema::create('konsultasi_items', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('nama');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('konsultasi_kategoris')->onDelete('cascade');
            $table->integer('harga');
            $table->integer('durasi');
            $table->bigInteger('no_tlp');
            $table->string('spealis');
            $table->string('lokasi_praktik');
            $table->date('pukul_mulai');
            $table->date('pukul_akhir');
            $table->json('pendidikan');
            $table->string('pengalaman');
            $table->string('fokus_konsultasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi_items');
    }
};
