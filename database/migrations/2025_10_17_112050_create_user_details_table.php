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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('education_degree_id')->constrained('education_degrees')->onDelete('cascade');
            $table->string('university')->nullable();
            $table->string('files')->nullable();
            $table->year('graduation_year')->nullable();
            $table->date('date_join')->nullable();
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('office_location_id')->constrained('office_locations')->onDelete('cascade');
            $table->string('whatsapp_number')->required();
            // Consolidated from 2025_11_13_075801: Partner number for letter formatting
            $table->string('partner_number', 10)->nullable()->comment('Partner number for letter formatting (e.g., 01, 02, 03)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
