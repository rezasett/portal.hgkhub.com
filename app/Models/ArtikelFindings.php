<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelFindings extends Model
{
    use HasFactory;
    // Relasi ke komentar reviewer
    public function reviewerComments()
    {
        return $this->hasMany(ArtikelFindingsReviewerComment::class, 'artikel_findings_id');
    }
    protected $table = 'artikel_findings';

    protected $fillable = [
        'std_akuntansi_id',
        'index',
        'periode',
        'artikel_judul',
        'artikel_slug',
        'artikel_deskripsi',
        'artikel_kondisi',
        'artikel_kriteria',
        'artikel_impact',
        'artikel_rekomendasi',
        'artikel_files',
        'penulis_id',
        'kategori_id',
        'glosarium_account_element_id',
        'glosarium_lead_account_id',
        'glosarium_industris_id',
        'assertion_id',
        'tags',
        'status',
        'updated_by',
        'nama_klien',
    ];

    protected $casts = [
        'artikel_files' => 'array',
        'tags' => 'array',
        'periode' => 'date',
    ];

    // Relasi ke User (Penulis)
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(GlosariumKategori::class, 'kategori_id');
    }

    // Relasi ke Akun
    public function akunElement()
    {
        return $this->belongsTo(GlosariumAccountElement::class, 'glosarium_account_element_id');
    }

    // Relasi ke Sub Akun
    public function leadAkun()
    {
        return $this->belongsTo(GlosariumLeadAccount::class, 'glosarium_lead_account_id');
    }

    // Relasi ke Industri
    public function industri()
    {
        return $this->belongsTo(GlosariumIndustri::class, 'glosarium_industris_id');
    }

    // Relasi ke Assertion
    public function assertion()
    {
        return $this->belongsTo(Assertion::class, 'assertion_id');
    }

    // Relasi ke User (Updated By)
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi ke Standar Akuntansi
    public function standarAkuntansi()
    {
        return $this->belongsTo(GlosariumStandarAkuntansi::class, 'std_akuntansi_id');
    }
}
