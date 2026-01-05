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
        Schema::create('memo_ca_areas', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->foreignId('from_branch_id')->constrained('office_locations')->onDelete('cascade');
            $table->string('name_area');
            $table->string('description')->nullable();
            $table->decimal('accomodation_rate', 10, 2);
            $table->decimal('transportation_rate', 10, 2);
            $table->decimal('perdiem_rate', 10, 2);
            $table->string('currency', 10)->default('IDR');
            $table->enum('status', [ 'draft','publish'])->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_ca_areas');
    }
};
