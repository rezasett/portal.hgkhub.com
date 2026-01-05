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
        Schema::create('memo_personel_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');

            $table->foreignId('personnel_manhour_id')->constrained('memo_userdetail_manhours')->onDelete('cascade');

            // Consolidated from 2025_11_05_000001: Changed from enum to string for flexibility
            $table->string('assignment_role', 100)->nullable();

            $table->date('assignment_start_date')->nullable();
            $table->date('assignment_end_date')->nullable();

            // Consolidated from 2025_10_31_000003 & 2025_11_03_091034: Changed to nullable integer
            $table->integer('working_hours')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_personel_allocations');
    }
};
