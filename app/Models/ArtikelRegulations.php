<?php

namespace App\Models;

use App\Models\User;
use App\Models\Assertion;
use App\Models\GlosariumAccount;
use App\Models\GlosariumIndustri;
use App\Models\GlosariumKategori;
use App\Models\GlosariumLeadAccount;
use App\Models\GlosariumAccountElement;
use App\Models\GlosariumStandarAkuntansi;
use App\Models\ArtikelRegulationReviewerComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelRegulations extends Model
{
    use HasFactory;
    protected $fillable = [
        'std_akuntansi_id',
        'index',
        'artikel_judul',
        'artikel_slug',
        'artikel_deskripsi',
        'artikel_regulator',
        'artikel_reference',
        'artikel_deskripsi_isi',
         'artikel_files',
      
        'penulis_id',
        'kategori_id',
        'glosarium_account_element_id',
        'glosarium_lead_account_id',
        'glosarium_industris_id',
        'assertion_id',
        'tags',
        'status',
        'updated_by'
    ];

    protected $casts = [
        'artikel_files' => 'array',
        'tags' => 'array',
        'periode' => 'date',
    ];

    public function standarAkuntansi()
    {
        return $this->belongsTo(GlosariumStandarAkuntansi::class, 'std_akuntansi_id');
    }

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

    public function assertion()
    {
        return $this->belongsTo(Assertion::class, 'assertion_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function reviewerComments()
    {
        return $this->hasMany(ArtikelRegulationReviewerComment::class, 'artikel_regulation_id');
    }
}
