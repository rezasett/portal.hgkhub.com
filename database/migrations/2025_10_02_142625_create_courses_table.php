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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('objectives')->nullable(); // Tujuan pembelajaran
            $table->string('level')->default('beginner'); // beginner, intermediate, advanced
            $table->integer('duration_hours')->nullable(); // Estimasi durasi dalam jam
            $table->string('thumbnail')->nullable(); // Path gambar thumbnail
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('draft'); // draft, published, archived
            $table->decimal('price', 10, 2)->default(0); // Harga kursus (0 = gratis)
            $table->integer('max_enrollments')->nullable(); // Batas maksimal peserta
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade'); // Pengajar
            $table->string('category')->nullable(); // Kategori sebagai string
            $table->unsignedBigInteger('category_id')->nullable(); // Kategori - untuk sementara tanpa foreign key
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
