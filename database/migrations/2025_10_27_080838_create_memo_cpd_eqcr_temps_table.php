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
        Schema::create('memo_cpd_eqcr_temps', function (Blueprint $table) {
            $table->id();
            $table->integer('order');//untuk urutan
            $table->string('title_eqcr');
            $table->text('description')->nullable();
            $table->string('item');
            $table->string('scoring');
            $table->enum('status', [ 'draft','publish'])->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cpd_eqcr_temps');
    }
};
