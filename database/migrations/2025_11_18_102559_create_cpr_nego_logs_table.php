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
        Schema::create('cpr_nego_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');

            $table->string('client_pic');
            $table->string('firm_pic'); 
            $table->enum('negotiation_status', ['negotiable', 'accepted', 'rejected'])->default('negotiable');
            $table->decimal('negotiation_amount', 15, 2);
            $table->string('negotiation_media');
            $table->date('negotiation_date');
            // Periode yang di-propose dalam negotiation ini
            $table->date('proposed_start_date')->nullable();
            $table->date('proposed_end_date')->nullable();
            
            $table->text('notes')->nullable();
            $table->text('review_notes')->nullable();

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpr_nego_logs');
    }
};
