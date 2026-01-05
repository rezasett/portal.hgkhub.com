<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('memo_p_a_stage_assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')
                ->constrained('memo_client_prospect_datas')
                ->onDelete('cascade');
            $table->foreignId('memo_personel_allocation_id')
                ->constrained('memo_personel_allocations')
                ->onDelete('cascade');
            //automated selected from PA Stage Temp if user fill the assign_manhour in PA Stage Temp
            $table->foreignId('memo_p_a_stage_temp_id')
                ->constrained('memo_p_a_stage_temps')
                ->onDelete('cascade');
                
            // Added fields for assigned manhour and cost
           $table->integer('assigned_manhour')->default(0);
           // get from personnel manhour rate * assigned manhour
           $table->decimal('assigned_cost', 15, 2)->default(0);

           $table->timestamps();

            // Indexes for faster queries and relationship integrity
            $table->index(['memo_client_prospect_data_id']);
            $table->index(['memo_personel_allocation_id']);
            $table->index(['memo_p_a_stage_temp_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_p_a_stage_assigns');
    }
};
