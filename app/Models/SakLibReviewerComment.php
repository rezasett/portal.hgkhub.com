<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SakLibReviewerComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sak_lib_id',
        'reviewer_id',
        'komentar',
    ];

    public function sakLib(): BelongsTo
    {
        return $this->belongsTo(SakLib::class, 'sak_lib_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
