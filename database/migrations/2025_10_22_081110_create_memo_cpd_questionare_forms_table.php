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
        Schema::create('memo_cpd_questionare_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');
            $table->foreignId('memo_cpd_questionare_temp_id')->constrained('memo_cpd_questionare_temps')->onDelete('cascade');
            $table->boolean('answer')->default(false);
            //scoring for eqcr risk (high,medium,low)
            $table->string('cpd_result_risk')->nullable();

            //get value score from memo_cpd_questionare_temps table load and assign when create record
            $table->integer('risk_score');
            
            //get result overall from 'answer' scoring (if all no is low risk but if any yes is high risk)
            $table->string('result_risk_overall');
            $table->string('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cpd_questionare_forms');
    }
};
