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
        Schema::create('artikel_regulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('std_akuntansi_id')->nullable()->constrained('glosarium_standar_akuntansis')->onDelete('set null');

            $table->string('index'); // Nomenklatur regulation
           
            $table->string('artikel_judul'); // Judul artikel regulation
            $table->string('artikel_slug')->unique(); // Slug untuk URL
            $table->text('artikel_deskripsi'); // Deskripsi singkat
            $table->longText('artikel_regulator'); // Regulator/badan yang mengeluarkan
            $table->longText('artikel_reference'); // Referensi/sumber regulation
            $table->longText('artikel_deskripsi_isi'); // Deskripsi lengkap 
           
            $table->json('artikel_files')->nullable(); // File attachments
            
        

            $table->foreignId('penulis_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('kategori_id')->constrained('glosarium_kategoris')->onDelete('cascade');
            
            $table->foreignId('glosarium_account_element_id')->constrained('glosarium_account_elements')->onDelete('cascade');
            $table->foreignId('glosarium_lead_account_id')->constrained('glosarium_lead_accounts')->onDelete('cascade');
            $table->foreignId('glosarium_industris_id')->constrained('glosarium_industris')->onDelete('cascade');
            $table->foreignId('assertion_id')->constrained('assertions')->onDelete('cascade');

            $table->json('tags')->nullable();
            $table->fullText('tags'); // index untuk pencarian tags

            // Status dan tracking
            $table->enum('status', ['Drop','Restore','Review','Reviewed','Revised','Published'])->default('Review');

            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_regulations');
    }
};
