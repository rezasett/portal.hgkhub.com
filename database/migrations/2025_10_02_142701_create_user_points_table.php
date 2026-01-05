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
        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('source_type'); // course_material, quiz, bonus, penalty, etc
            $table->unsignedBigInteger('source_id')->nullable(); // ID dari source (material_id, dll)
            $table->integer('points'); // Poin yang didapat (bisa minus untuk penalty)
            $table->string('description')->nullable(); // Deskripsi perolehan poin
            $table->json('metadata')->nullable(); // Data tambahan jika diperlukan
            $table->timestamp('earned_at')->useCurrent();
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['user_id', 'source_type']);
            $table->index(['user_id', 'earned_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_points');
    }
};
