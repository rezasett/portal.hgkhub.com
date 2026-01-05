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
        Schema::create('course_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content')->nullable(); // Konten materi (HTML/Markdown)
            $table->string('type')->default('text'); // text, video, audio, document, quiz
            $table->string('file_path')->nullable(); // Path file jika ada
            // Consolidated from 2025_10_02_162043: Additional attachment path
            $table->string('attachment_path')->nullable(); // Additional attachment path
            $table->string('video_url')->nullable(); // URL video jika tipe video
            $table->integer('duration_minutes')->nullable(); // Durasi dalam menit
            $table->integer('points')->default(10); // Poin yang didapat setelah menyelesaikan
            $table->integer('order_index')->default(0); // Urutan materi
            $table->boolean('is_required')->default(true); // Wajib atau opsional
            $table->boolean('is_active')->default(true);
            $table->json('quiz_data')->nullable(); // Data kuis jika tipe quiz
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_materials');
    }
};
