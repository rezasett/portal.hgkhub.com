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
        Schema::create('memo_client_prospect_datas', function (Blueprint $table) {
            $table->id();
            //data engagement
            $table->foreignId('office_location_id')->constrained('office_locations')->onDelete('cascade');
            $table->foreignId('memo_engagement_type_id')->constrained('memo_engagement_types')->onDelete('cascade');
            $table->enum('audit_standard', ['SA', 'SAP'])->default('SA');
            $table->foreignId('manager_id')->constrained('user_details')->onDelete('cascade');
            $table->foreignId('partner_id')->constrained('user_details')->onDelete('cascade');
            $table->foreignId('partner_signed_id')->constrained('user_details')->onDelete('cascade');

            $table->foreignId('eqr_id')->constrained('eqr_assigns')->onDelete('cascade');

            $table->string('client_name');
            $table->string('initials')->nullable();
            $table->string('npwp')->nullable();
            $table->year('established_year')->nullable();

             //relasi ke tabel lain
            $table->foreignId('ownership_status_id')->constrained('memo_ownership_statuses')->onDelete('cascade');
            $table->foreignId('industri_sector_id')->constrained('glosarium_industris')->onDelete('cascade');

            //ambil dari client profile
           
            $table->foreignId('financing_status_id')->constrained('memo_financing_statuses')->onDelete('cascade');
            $table->foreignId('accounting_standar_id')->constrained('glosarium_standar_akuntansis')->onDelete('cascade');
          
            //data client 
            $table->date('engagement_periode')->nullable();
            $table->foreignId('engagement_service_id')->constrained('memo_engagement_services')->onDelete('cascade');
            $table->date('engagement_date')->nullable();
            
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('province_id')->constrained('provinsis')->onDelete('cascade');
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('office_telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable(); 

            //data PIC client
            $table->string('pic_name');
            $table->string('pic_email')->nullable();
            $table->string('pic_phone')->nullable();
            //pengguna yang membuat record
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            //status module
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('memo_client_prospect_datas');
    }
};
