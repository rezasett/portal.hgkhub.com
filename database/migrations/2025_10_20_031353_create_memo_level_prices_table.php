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
        Schema::create('memo_level_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->foreignId('branch_id')->constrained('office_locations')->onDelete('cascade')->nullable();
            $table->string('level_name');
            $table->string('description');
            $table->date('effective_date');
            $table->decimal('price', 15, 2);
            $table->string('currency')->default('IDR');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_level_prices');
    }
};
