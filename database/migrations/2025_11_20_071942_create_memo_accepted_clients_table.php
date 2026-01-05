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
        Schema::create('memo_accepted_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');
            $table->foreignId('accepted_nego_log_id')->constrained('cpr_nego_logs')->onDelete('cascade');
            
            // Snapshot data dari negotiation yang di-accept
            $table->decimal('accepted_fee', 15, 2);
            $table->date('accepted_start_date');
            $table->date('accepted_end_date');
            
            // Lifecycle setelah accepted
            $table->enum('engagement_status', ['active', 'on_hold', 'completed', 'cancelled'])->default('active');
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            
            // Completion tracking
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('completed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('completion_notes')->nullable();
            
            // Cancellation tracking
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('cancellation_reason')->nullable();
            
            // Acceptance info
            $table->foreignId('accepted_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('accepted_at')->useCurrent();
            
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_accepted_clients');
    }
};
