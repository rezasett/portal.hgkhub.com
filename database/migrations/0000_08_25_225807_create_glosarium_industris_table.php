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
        Schema::create('glosarium_industris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_industri');
            $table->text('deskripsi')->nullable();
            // Scoring for EQCR risk assessment - consolidated from 2025_10_30_045310
            $table->integer('risk_score');
            $table->string('eqr_priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glosarium_industris');
    }
};
