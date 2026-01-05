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
        Schema::create('memo_client_financials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');
            $table->decimal('total_current_assets', 15, 2)->nullable();
            $table->decimal('total_non_current_assets', 15, 2)->nullable();
            $table->decimal('total_short_term_liability', 15, 2)->nullable();
            $table->decimal('total_long_term_liability', 15, 2)->nullable();
            $table->decimal('total_equity', 15, 2)->nullable();
            $table->decimal('total_revenue', 15, 2)->nullable();
            $table->decimal('total_expenses', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_client_financials');
    }
};
