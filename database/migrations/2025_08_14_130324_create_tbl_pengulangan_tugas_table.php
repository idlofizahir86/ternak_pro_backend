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
        Schema::create('tbl_pengulangan_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')->references('uid')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pengulangan_tugas_id');
            $table->foreign('pengulangan_tugas_id')->references('id')->on('m_pengulangan_tugas')->onDelete('cascade');
            $table->integer('n_pengulangan');
            $table->string('satuan_pengulangan');
            $table->json('hari_pengulangan');
            $table->integer('n_kerekapan');
            $table->integer('total_kerekapan');
            $table->date('tgl_akhir');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_pengulangan_tugas');
    }
};
