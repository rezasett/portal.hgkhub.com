<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('artikel_findings_reviewer_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artikel_findings_id');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->text('komentar')->nullable();
            $table->timestamps();

            $table->foreign('artikel_findings_id')->references('id')->on('artikel_findings')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel_findings_reviewer_comments');
    }
};
