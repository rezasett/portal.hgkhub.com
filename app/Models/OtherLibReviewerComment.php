<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherLibReviewerComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'other_lib_id',
        'reviewer_id',
        'komentar',
    ];

    public function otherLib(): BelongsTo
    {
        return $this->belongsTo(OtherLib::class, 'other_lib_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
