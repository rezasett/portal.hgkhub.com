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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('jabatan_id')->constrained('role_jabatans')->onDelete('cascade')->nullable();
            
            // Consolidated from 2025_09_17_000001: Changed from single to JSON for multiple industries
            $table->json('glosarium_industri_ids')->nullable();
            
            // Consolidated from 2025_10_16_140023: User initials
            $table->string('initial', 3)->nullable();

            $table->enum('role', ['admin','auditor', 'preparer', 'reviewer'])->default('auditor');
            
            $table->json('access_urls')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->string('profile_photo')->nullable();
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
