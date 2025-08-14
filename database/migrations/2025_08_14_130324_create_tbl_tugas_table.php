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
        Schema::create('tbl_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')->references('uid')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_tugas_id');
            $table->foreign('jenis_tugas_id')->references('id')->on('m_jenis_tugas')->onDelete('cascade');
            $table->date('tgl_tugas');
            $table->time('waktu_tugas');
            $table->unsignedBigInteger('status_tugas_id');
            $table->foreign('status_tugas_id')->references('id')->on('m_status_tugas')->onDelete('cascade');
            $table->unsignedBigInteger('pengulangan_id');
            $table->foreign('pengulangan_id')->references('id')->on('m_pengulangan_tugas')->onDelete('cascade');
            $table->boolean('is_pengingat')->default(false);
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_tugas');
    }
};
