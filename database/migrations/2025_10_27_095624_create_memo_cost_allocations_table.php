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
        Schema::create('memo_cost_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade')->index();
            $table->foreignId('memo_personel_id')->constrained('memo_personel_allocations')->onDelete('cascade');
            $table->foreignId('memo_ca_area_id')->constrained('memo_ca_areas')->onDelete('cascade');
            $table->decimal('q_accommodation', 15, 2)->default(0);
            $table->decimal('accomodation_rate', 15, 2)->default(0);//dari field template di load jadi decimal biar ada info terakhir rate(kalau berubah)
            $table->decimal('total_cost_allocation', 15, 2)->default(0);
            $table->decimal('q_transport', 15, 2)->default(0);
            $table->decimal('transport_rate', 15, 2)->default(0);//dari field template di load jadi decimal biar ada info terakhir rate(kalau berubah)
            $table->decimal('total_cost_transport', 15, 2)->default(0);
            $table->decimal('q_perdiem', 15, 2)->default(0);
            $table->decimal('perdiem_rate', 15, 2)->default(0);//dari field template di load jadi decimal biar ada info terakhir rate(kalau berubah)
            $table->decimal('total_cost_perdiem', 15, 2)->default(0);
            $table->decimal('other_cost', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_cost_allocations');
    }
};
