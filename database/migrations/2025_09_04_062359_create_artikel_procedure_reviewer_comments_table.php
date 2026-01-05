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
        Schema::create('artikel_procedure_reviewer_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_procedure_id')->constrained('artikel_procedures')->onDelete('cascade')->nullable();

            
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');

            $table->text('komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_procedure_reviewer_comments');
    }
};
