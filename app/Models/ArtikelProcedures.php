<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelProcedures extends Model
{
    use HasFactory;
    protected $table = 'artikel_procedures';

    protected $fillable = [
        'std_akuntansi_id',
        'index',
        'artikel_judul',
        'artikel_slug',
        'artikel_deskripsi',
        'artikel_audit_objectives',
        'artikel_files',
        'penulis_id',
        'kategori_id',
        'glosarium_account_element_id',
        'glosarium_lead_account_id',
        'glosarium_industris_id',
        'tags',
        'status',
        'updated_by',
    ];

    protected $casts = [
        'artikel_files' => 'array',
        'tags' => 'array',
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    public function kategori()
    {
        return $this->belongsTo(GlosariumKategori::class, 'kategori_id');
    }

    public function akunElement()
    {
        return $this->belongsTo(GlosariumAccountElement::class, 'glosarium_account_element_id');
    }

    public function leadAkun()
    {
        return $this->belongsTo(GlosariumLeadAccount::class, 'glosarium_lead_account_id');
    }

    public function industri()
    {
        return $this->belongsTo(GlosariumIndustri::class, 'glosarium_industris_id');
    }

    public function reviewerComments()
    {
        return $this->hasMany(ArtikelProcedureReviewerComments::class, 'artikel_procedure_id');
    }

    public function detail()
    {
        return $this->hasMany(ArtikelProcedureDetail::class, 'artikel_procedures_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function standarAkuntansi()
    {
        return $this->belongsTo(GlosariumStandarAkuntansi::class, 'std_akuntansi_id');
    }
}
