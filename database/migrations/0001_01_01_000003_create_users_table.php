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
        // Create the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->string('uid')->primary();  // Primary key adalah 'uid'
            $table->string('name');
            $table->string('email')->unique();
            $table->string('no_telepon')->nullable(); // No Telepon
            $table->string('profile_image')->nullable(); // Path image URL
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id');  // Kolom role_id menggunakan unsignedBigInteger
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); // Foreign key
            $table->rememberToken();
            $table->timestamps();
        });

        // Create the 'password_reset_tokens' table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create the 'sessions' table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();  // Use string as primary key for 'id'
            $table->foreignId('user_id')->nullable()->index(); // Foreign key to 'users' table
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the tables in the correct order
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key and role_id column in 'users' table
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        // Drop the rest of the tables
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
