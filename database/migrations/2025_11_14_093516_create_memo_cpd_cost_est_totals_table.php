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
        //for memo cpd cost estimation totals
        Schema::create('memo_cpd_cost_est_totals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');
            $table->enum('risk_level', ['Low', 'Medium', 'High']);
            $table->decimal('total_man_hour', 15, 2);
            $table->decimal('total_cost_allocation', 15, 2);

            // input di cpr
            $table->decimal('based_price', 15, 2);
            $table->integer('overhead_percentage');
            $table->decimal('total_basedprice_overhead', 15, 2);
            $table->integer('profit_margin_percentage');
            $table->decimal('margin_amount', 15, 2);
            $table->decimal('fee_before_tax', 15, 2);
            $table->integer('ppn_tax_percentage');
            $table->decimal('ppn_tax', 15, 2);
            $table->decimal('total_fee_after_tax', 15, 2);
            $table->decimal('estimated_client_price', 15, 2);

            $table->decimal('final_fee', 15, 2)->nullable();// get from nego log final amount
            $table->enum('status', ['Open', 'Approved', 'Rejected'])->default('Open');


            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cpd_cost_est_totals');
    }
};
