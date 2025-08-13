<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_roles_table.php

    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();  // Kolom id sebagai primary key
            $table->string('nama_role');
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('roles');
    }

};
