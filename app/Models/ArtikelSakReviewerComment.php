<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ArtikelSak;
use App\Models\User;

class ArtikelSakReviewerComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'index', 'judul', 'slug', 'artikel_judul', 'artikel_deskripsi', 'artikel_konten', 'artikel_files',
        'penulis_id', 'review_id', 'kategori_id', 'akun_id', 'sub_akun_id', 'industri_id', 'assertion_id', 'status',
        'artikel_sak_id',
        'reviewer_id',
        'komentar',
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
        return $this->belongsTo(GlosariumAccountElement::class, 'akun_id');
    }

    public function leadAkun()
    {
        return $this->belongsTo(GlosariumLeadAccount::class, 'sub_akun_id');
    }

    public function industri()
    {
        return $this->belongsTo(GlosariumIndustri::class, 'industri_id');
    }

    public function assertion()
    {
        return $this->belongsTo(Assertion::class, 'assertion_id');
    }

    public function artikelSak()
    {
        return $this->belongsTo(ArtikelSak::class, 'artikel_sak_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
