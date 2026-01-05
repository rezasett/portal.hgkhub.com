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
        Schema::create('user_point_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_points')->default(0);
            $table->integer('earned_today')->default(0);
            $table->integer('level')->default(1);
            $table->integer('next_level_points')->default(100);
            $table->timestamp('last_earned_date')->nullable();
            $table->timestamps();
            
            // Index untuk performa query
            $table->unique('user_id');
            $table->index(['total_points', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_point_summaries');
    }
};
