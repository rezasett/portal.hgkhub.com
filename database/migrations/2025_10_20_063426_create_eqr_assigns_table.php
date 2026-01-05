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
        Schema::create('eqr_assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eqr_id')->constrained('user_details')->onDelete('cascade');
            $table->date('assigned_date');
            $table->year('start_period');
            $table->year('end_period');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eqr_assigns');
    }
};
