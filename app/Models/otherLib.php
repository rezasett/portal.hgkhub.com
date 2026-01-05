<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherLib extends Model
{ 
    use HasFactory;
    protected $table = 'other_libs';
    //kena apa ini gak kebaca
    protected $fillable = [
        'index',
        'artikel_judul',
        'artikel_slug',
        'artikel_deskripsi',
        'artikel_files',
        'penulis_id',
        'kategori_id',
        'glosarium_industris_id',
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

    public function industri(): BelongsTo
    {
        return $this->belongsTo(GlosariumIndustri::class, 'glosarium_industris_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function reviewerComments()
    {
        return $this->hasMany(OtherLibReviewerComment::class, 'other_lib_id');
    }
}
