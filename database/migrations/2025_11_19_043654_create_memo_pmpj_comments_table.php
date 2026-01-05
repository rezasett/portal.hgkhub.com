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
        Schema::create('memo_pmpj_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_pmpj_id')->constrained('memo_pmpjs')->onDelete('cascade');
            $table->foreignId('memo_pmpj_temp_id')->constrained('memo_pmpj_temps')->onDelete('cascade');
            
            $table->text('comment_detail');

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_pmpj_comments');
    }
};
