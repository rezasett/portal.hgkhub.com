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
        Schema::create('engagement_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_accepted_client_id')->constrained('memo_accepted_clients')->onDelete('cascade');
            $table->string('letter_number')->unique();
            $table->date('letter_date');
            $table->text('letter_description')->nullable();
            $table->string('file_path')->nullable();
            $table->json('engagement_files')->nullable();
            $table->integer('auto_increment_number');
            $table->enum('letter_type', ['original', 'amendment', 'renewal'])->default('original');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engagement_letters');
    }
};
