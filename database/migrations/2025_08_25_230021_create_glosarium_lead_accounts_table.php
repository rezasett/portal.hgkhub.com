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
        Schema::create('glosarium_lead_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lead_akun');
            $table->foreignId('glosarium_account_element_id')->nullable()->constrained('glosarium_account_elements')->onDelete('set null');
            $table->foreignId('glosarium_industris_id')->nullable()->constrained('glosarium_industris')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glosarium_lead_accounts');
    }
};
