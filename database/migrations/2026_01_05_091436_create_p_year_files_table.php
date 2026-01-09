<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. portal.hgkhub.com
     */
    public function up(): void
    {
        Schema::create('p_year_files', function (Blueprint $table) {
            $table->id();
            $table->year('year')->unique();
            $table->enum('status', ['active', 'locked','revise'])->default('active');
            $table->date('locked_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_year_files');
    }
};
