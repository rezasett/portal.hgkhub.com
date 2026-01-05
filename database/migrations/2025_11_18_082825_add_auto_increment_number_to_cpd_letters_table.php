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
        Schema::table('cpd_letters', function (Blueprint $table) {
            $table->integer('auto_increment_number')->nullable()->after('letter_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpd_letters', function (Blueprint $table) {
            $table->dropColumn('auto_increment_number');
        });
    }
};
