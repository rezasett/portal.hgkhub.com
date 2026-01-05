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
        Schema::create('ra_inherent_risk_assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ra_inherent_risks_id')->constrained('ra_inherent_risks')->onDelete('cascade');
            $table->foreignId('ra_inherent_risk_temps_id')->constrained('ra_inherent_risk_temps')->onDelete('cascade');
            $table->enum('answer', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_inherent_risk_assigns');
    }
};
