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
        // control risk account levels (detail per account dalam cycle)
        Schema::create('ra_cr_account_lvls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ra_tb_mapping_id')->constrained('ra_tb_mappings')->onDelete('cascade');
            $table->foreignId('ra_cycle_setting_id')->constrained('ra_cycle_settings')->onDelete('cascade');
            $table->enum('result_account', ['Effective', 'Non Effective'])->nullable();
            $table->enum('final_result', ['Effective', 'Non Effective'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_cr_account_lvls');
    }
};
