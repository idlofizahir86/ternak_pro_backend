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
        Schema::create('tbl_ternaks', function (Blueprint $table) {
            $table->id();
            $table->string('tag_id');
            $table->string('user_id');
            $table->foreign('user_id')->references('uid')->on('users')->onDelete('cascade');
            $table->string('nama_ternak');
            $table->date('tgl_mulai');
            $table->unsignedBigInteger('hewan_id');
            $table->foreign('hewan_id')->references('id')->on('m_hewans')->onDelete('cascade');
            $table->unsignedBigInteger('ras_id');
            $table->foreign('ras_id')->references('id')->on('m_ras')->onDelete('cascade');
            $table->unsignedBigInteger('tujuan_ternak_id');
            $table->foreign('tujuan_ternak_id')->references('id')->on('m_tujuan_ternaks')->onDelete('cascade');
            $table->unsignedBigInteger('usia')->default(0);
            $table->string('kondisi_ternak');
            $table->string('jenis_kelamin');
            $table->float('berat');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_ternaks');
    }
};
