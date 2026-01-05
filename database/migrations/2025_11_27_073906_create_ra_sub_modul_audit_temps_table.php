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

        ///blm ada crudnya baru seeder
        Schema::create('ra_sub_modul_audit_temps', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('name_sub_modul_audit_temp');
            $table->string('description')->nullable();
            $table->string('route_url')->nullable();
            $table->string('route_name')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_modul_audit_temps');
    }
};
