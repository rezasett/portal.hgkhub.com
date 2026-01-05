<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    //these are status can be used as validation for each module and each role users

    public function up(): void
    {
        Schema::create('memo_status_overalls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->nullable()->constrained('memo_client_prospect_datas')->onDelete('cascade');
            $table->string('module_name');
            $table->enum('module_status', ['Save', 'Validate', 'Reviewed', 'Approved', 'QC Passed', 'Revised', 'Reverse'])->default('Save');
            $table->text('note')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_status_overalls');
    }
};
