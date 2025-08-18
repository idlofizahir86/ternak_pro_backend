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
        Schema::create('suplier_items', function (Blueprint $table) {
            $table->id();
            $table->json('image_url');
            $table->string('judul');
            $table->mediumText('detail');
            $table->mediumText('khasiat');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('suplier_kategoris')->onDelete('cascade');
            $table->boolean('is_stok')->default(true);
            $table->integer('harga');
            $table->bigInteger('no_tlp');
            $table->string('alamat_overview');
            $table->string('alamat');
            $table->string('maps_link');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suplier_items');
    }
};
