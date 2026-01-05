<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SakLib extends Model
{
    use HasFactory;
    protected $table = 'sak_libs';
    
    protected $fillable = [
        'std_akuntansi_id',
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

    protected $casts = [
        'artikel_files' => 'array',
        'tags' => 'array',
    ];

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(GlosariumKategori::class, 'kategori_id');
    }

    public function standarAkuntansi(): BelongsTo
    {
        return $this->belongsTo(GlosariumStandarAkuntansi::class, 'std_akuntansi_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function reviewerComments()
    {
        return $this->hasMany(SakLibReviewerComment::class, 'sak_lib_id');
    }
}
