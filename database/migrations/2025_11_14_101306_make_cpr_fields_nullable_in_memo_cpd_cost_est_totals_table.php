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
        Schema::table('memo_cpd_cost_est_totals', function (Blueprint $table) {
            
            // Ubah field-field CPR menjadi nullable
            $table->decimal('based_price', 15, 2)->nullable()->change();
            $table->integer('overhead_percentage')->nullable()->change();
            $table->decimal('total_basedprice_overhead', 15, 2)->nullable()->change();
            $table->integer('profit_margin_percentage')->nullable()->change();
            $table->decimal('margin_amount', 15, 2)->nullable()->change();
            $table->decimal('fee_before_tax', 15, 2)->nullable()->change();
            $table->integer('ppn_tax_percentage')->nullable()->change();
            $table->decimal('ppn_tax', 15, 2)->nullable()->change();
            $table->decimal('total_fee_after_tax', 15, 2)->nullable()->change();
            $table->decimal('estimated_client_price', 15, 2)->nullable()->change();
            
            // Ubah juga approved_by menjadi nullable karena bisa diisi nanti
            $table->foreignId('approved_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memo_cpd_cost_est_totals', function (Blueprint $table) {
            // Kembalikan ke NOT NULL jika rollback
            $table->decimal('based_price', 15, 2)->nullable(false)->change();
            $table->integer('overhead_percentage')->nullable(false)->change();
            $table->decimal('total_basedprice_overhead', 15, 2)->nullable(false)->change();
            $table->integer('profit_margin_percentage')->nullable(false)->change();
            $table->decimal('margin_amount', 15, 2)->nullable(false)->change();
            $table->decimal('fee_before_tax', 15, 2)->nullable(false)->change();
            $table->integer('ppn_tax_percentage')->nullable(false)->change();
            $table->decimal('ppn_tax', 15, 2)->nullable(false)->change();
            $table->decimal('total_fee_after_tax', 15, 2)->nullable(false)->change();
            $table->decimal('estimated_client_price', 15, 2)->nullable(false)->change();
            
            $table->foreignId('approved_by')->nullable(false)->change();
        });
    }
};
