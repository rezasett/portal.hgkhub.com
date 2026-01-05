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
        Schema::create('memo_cpd_eqcr_recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memo_client_prospect_data_id');
            $table->text('eqcr_recommendation')->nullable();
            $table->timestamps();
            
            // Add foreign key with custom name
            $table->foreign('memo_client_prospect_data_id', 'fk_eqcr_rec_client_id')
                ->references('id')
                ->on('memo_client_prospect_datas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cpd_eqcr_recommendations');
    }
};
