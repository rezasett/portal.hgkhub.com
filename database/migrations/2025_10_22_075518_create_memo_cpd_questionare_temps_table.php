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
        Schema::create('memo_cpd_questionare_temps', function (Blueprint $table) {
            $table->id();
            $table->string('section')->nullable();
            $table->string('questionare')->nullable();
            //scoring for eqcr risk (high,medium,low)
            $table->integer('risk_score') ;
            $table->string('eqr_priority');
            $table->enum('status', [ 'draft','publish'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cpd_questionare_temps');
    }
};
