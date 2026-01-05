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
        Schema::create('ra_inherent_risks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_accepted_clients_id')->constrained('memo_accepted_clients')->onDelete('cascade');
            $table->foreignId('ra_tb_mappings_id')->constrained('ra_tb_mappings')->onDelete('cascade');
            $table->foreignId('ra_materialities_id')->constrained('ra_materialities')->onDelete('cascade');
            
            $table->string('cycle');
            $table->string('lead_account');
            $table->decimal('balance', 15, 2);
            $table->decimal('materiality_scoping', 15, 2)->nullable();
            $table->string('IR_result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_inherent_risks');
    }
};
