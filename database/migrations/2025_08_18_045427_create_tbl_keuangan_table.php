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
        Schema::create('tbl_keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')->references('uid')->on('users')->onDelete('cascade');
            $table->boolean('is_pengeluaran')->default(false);
            $table->date('tgl_keuangan');
            $table->integer('nominal_total');
            $table->string('dari_tujuan');
            $table->unsignedBigInteger('aset_id');
            $table->foreign('aset_id')->references('id')->on('m_assets')->onDelete('cascade');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_keuangans');
    }
};
