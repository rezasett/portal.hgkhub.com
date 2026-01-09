<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{  
    /**
     * Run the migrations. udh apa blum??
     */
    public function up(): void
    {
        //control risk cycle levels
        Schema::create('ra_cr_cycle_lvls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ra_cycle_setting_id')->constrained('ra_cycle_settings')->onDelete('cascade');
            $table->enum('frequency', ['Daily', 'Weekly', 'Monthly', 'Quarterly', 'Annually', 'Other'])->default('Other')->nullable();
            $table->string('walkthrough_file')->nullable();
            $table->string('test_of_control_file')->nullable();
            $table->enum('effectiveness', ['Effective', 'Ineffective'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_cr_cycle_lvls');
    }
};
