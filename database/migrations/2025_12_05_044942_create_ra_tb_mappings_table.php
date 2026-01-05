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
        Schema::create('ra_tb_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_accepted_clients_id')->constrained('memo_accepted_clients')->onDelete('cascade');
            
            $table->string('coa')->nullable();
            $table->string('account_name')->nullable();
            $table->decimal('balance', 15, 2)->nullable();
        //load from glosarium_account_elements
            $table->foreignId('glosarium_account_elements_id')->constrained('glosarium_account_elements')->onDelete('cascade');
        //    take cycle from ra_cycle_settings
            $table->foreignId('ra_cycle_setting_id')->constrained('ra_cycle_settings')->onDelete('cascade');
            
            $table->string('lead_account')->nullable();
        // filter from glosarium_account_elements_id if selected
        
            $table->foreignId('glosarium_lead_accounts_id')->nullable()->constrained('glosarium_lead_accounts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_tb_mappings');
    }
};
