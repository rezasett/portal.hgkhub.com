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
        Schema::create('cpd_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memo_client_prospect_data_id')->constrained('memo_client_prospect_datas')->onDelete('cascade');
            //auto generate number letter formatted [auto increment from 001].[number of partner].06/[initial name of client]/HGK.HO/[month in greek]-[year]
            $table->string('letter_number_proposal');
            $table->date('letter_date');
            $table->text('letter_description')->nullable();
            $table->string('file_path_proposal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpd_letters');
    }
};
