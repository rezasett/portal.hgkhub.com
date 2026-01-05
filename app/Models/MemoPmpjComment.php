<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemoPmpjComment extends Model
{
    protected $fillable = [
        'memo_pmpj_id',
        'memo_pmpj_temp_id', 
        'comment_detail',
        'created_by'
    ];

    public function pmpj(): BelongsTo
    {
        return $this->belongsTo(MemoPmpj::class, 'memo_pmpj_id');
    }

    public function pmpjTemp(): BelongsTo
    {
        return $this->belongsTo(memoPmpjTemp::class, 'memo_pmpj_temp_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
