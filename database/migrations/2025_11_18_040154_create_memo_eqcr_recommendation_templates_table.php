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
        Schema::create('memo_eqcr_recommendation_templates', function (Blueprint $table) {
            $table->id();
            $table->string('risk_level'); // very_high, high, medium, low_medium, low
            $table->integer('score_result');
            $table->text('template_text');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_eqcr_recommendation_templates');
    }
};
