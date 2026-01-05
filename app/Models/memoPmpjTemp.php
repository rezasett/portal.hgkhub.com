<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class memoPmpjTemp extends Model
{
    protected $table = 'memo_pmpj_temps';
    
    protected $fillable = [
        'order',
        'pmpj_item',
        'status'
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'string'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(MemoPmpjComment::class, 'memo_pmpj_temp_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
