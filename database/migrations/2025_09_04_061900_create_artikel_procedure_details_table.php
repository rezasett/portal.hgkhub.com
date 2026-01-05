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
        Schema::create('artikel_procedure_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_procedures_id')->constrained('artikel_procedures')->onDelete('cascade');
            $table->string('procedure');
            
            // Consolidated from 2025_10_03_000001: Changed from single assertion_id to JSON array
            $table->json('assertion_ids')->nullable();
            
            $table->text('objective_detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_procedure_details');
    }
};
