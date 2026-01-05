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
        Schema::create('other_libs', function (Blueprint $table) {
            $table->id();
            
            $table->string('index');
            $table->string('artikel_judul');
            $table->string('artikel_slug')->unique();
            $table->text('artikel_deskripsi');
            $table->json('artikel_files')->nullable(); 

            $table->foreignId('penulis_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('kategori_id')->constrained('glosarium_kategoris')->onDelete('cascade');
            $table->foreignId('glosarium_industris_id')->nullable()->constrained('glosarium_industris')->onDelete('set null');
                                 
            $table->json('tags')->nullable();
            $table->fullText('tags'); // index untuk pencarian tags

            //status dan tanggal dibuat
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
        Schema::dropIfExists('other_libs');
    }
};
