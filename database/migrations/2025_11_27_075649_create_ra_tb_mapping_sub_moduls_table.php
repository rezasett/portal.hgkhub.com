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
        Schema::create('ra_tb_mapping_sub_moduls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_acc_client_id')->constrained('memo_accepted_clients')->onDelete('cascade');
            $table->foreignId('sub_modul_audit_temp_id')->constrained('ra_sub_modul_audit_temps')->onDelete('cascade');

            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->enum('role_assign', ['Viewer','Preparer', 'Validator', 'Reviewer', 'Approver', 'QC Reviewer'])->default('Viewer');
            // status
                       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mapping_sub_moduls');
    }
};
