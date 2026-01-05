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
        Schema::create('course_material_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_material_id')->constrained()->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->integer('points_earned')->default(0);
            $table->decimal('score', 5, 2)->nullable(); // Untuk quiz/assessment (0-100)
            $table->integer('time_spent_minutes')->nullable(); // Waktu yang dihabiskan
            $table->json('quiz_answers')->nullable(); // Jawaban quiz jika ada
            $table->text('notes')->nullable(); // Catatan peserta untuk materi ini
            $table->timestamps();
            
            // Unique constraint - satu user hanya bisa menyelesaikan satu kali per materi
            $table->unique(['user_id', 'course_material_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_material_completions');
    }
};
