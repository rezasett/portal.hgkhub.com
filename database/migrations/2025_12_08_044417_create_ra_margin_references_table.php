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
        Schema::create('ra_margin_references', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('name');
            $table->enum('type', ['om', 'pm', 'sud']);
            $table->string('percentage');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_margin_references');
    }
};
