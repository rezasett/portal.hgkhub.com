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
        Schema::create('memo_userdetail_manhours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_detail_id')->constrained('user_details')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('memo_level_prices')->onDelete('cascade');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('memo_userdetail_manhours');
    }
};
