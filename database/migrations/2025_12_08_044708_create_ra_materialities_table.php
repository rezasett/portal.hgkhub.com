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
        Schema::create('ra_materialities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_accepted_clients_id')->constrained('memo_accepted_clients')->onDelete('cascade');

            $table->decimal('total_assets', 15, 2);
            $table->decimal('total_liabilities', 15, 2);
            $table->decimal('total_equity', 15, 2);
            $table->decimal('total_revenue', 15, 2);
            $table->decimal('total_expenses', 15, 2);
            $table->decimal('total_ebt', 15, 2);
            
            $table->string('benchmark_selection');
            $table->decimal('benchmark_value', 15, 2);

            $table->decimal('om_percentage_margin', 5, 2)->default(0);
            $table->decimal('om_amount', 15, 2)->default(0);
            $table->text('om_decision_note')->nullable();
            
            $table->decimal('pm_percentage_margin', 5, 2)->default(0);
            $table->decimal('pm_amount', 15, 2)->default(0);
            $table->text('pm_decision_note')->nullable();

            $table->decimal('sud_percentage_margin', 5, 2)->default(0);
            $table->decimal('sud_amount', 15, 2)->default(0);
            $table->text('sud_decision_note')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_materialities');
    }
};
