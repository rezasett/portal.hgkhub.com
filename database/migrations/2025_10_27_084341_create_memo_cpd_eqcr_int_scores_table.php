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
        Schema::create('memo_cpd_eqcr_int_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')
                ->constrained('memo_client_prospect_datas')
                ->onDelete('cascade');
            $table->foreignId('item')
                ->constrained('memo_cpd_eqcr_temps')
                ->onDelete('cascade');
            $table->string('internal_score');
            $table->string('result');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cpd_eqcr_int_scores');
    }
};
