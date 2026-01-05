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
        Schema::create('ra_job_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_personel_allocation_id')->constrained('memo_personel_allocations')->onDelete('cascade');
            $table->foreignId('ra_cycle_setting_id')->constrained('ra_cycle_settings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_job_allocations');
    }
};
