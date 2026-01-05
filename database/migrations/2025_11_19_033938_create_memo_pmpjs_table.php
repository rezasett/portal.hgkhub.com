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
        Schema::create('memo_pmpjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');
            $table->enum('bo_profile_risk', ['high', 'low']);
            $table->enum('business_profile_risk', ['high', 'low']);
            $table->enum('domicile_profile_risk', ['high', 'low']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_pmpjs');
    }
};
