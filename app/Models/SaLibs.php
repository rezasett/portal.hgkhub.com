<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaLibs extends Model
{
    protected $fillable = [
        'std_profesi_id',
        'index',
        'artikel_judul',
        'artikel_slug',
        'artikel_deskripsi',
        'artikel_files',
        'penulis_id',
        'kategori_id',
        'tags',
        'status',
        'updated_by',
    ];

    public function standarProfesi()
    {
        return $this->belongsTo(\App\Models\GlosariumStandarProfesi::class, 'std_profesi_id');
    }

    public function penulis()
    {
        return $this->belongsTo(\App\Models\User::class, 'penulis_id');
    }

    public function kategori()
    {
        return $this->belongsTo(\App\Models\GlosariumKategori::class, 'kategori_id');
    }
}
