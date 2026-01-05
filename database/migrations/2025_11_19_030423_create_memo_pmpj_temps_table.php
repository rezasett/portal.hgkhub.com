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
        Schema::create('memo_pmpj_temps', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('pmpj_item');
            $table->enum('status', ['draft', 'publish']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_pmpj_temps');
    }
};
