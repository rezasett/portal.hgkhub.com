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
        Schema::create('memo_ownership_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('ownership_status_name');
            $table->string('detail')->nullable();
               //scoring for eqcr risk (high,medium,low)
            $table->integer('risk_score');
            $table->string('eqr_priority')  ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_ownership_statuses');
    }
};
