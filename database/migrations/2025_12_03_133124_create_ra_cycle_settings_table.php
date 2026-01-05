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
        Schema::create('ra_cycle_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ra_tb_mapping_id')->constrained('ra_tb_mapping_sub_moduls')->onDelete('cascade');
            $table->string('cycle_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_settings');
    }
};
