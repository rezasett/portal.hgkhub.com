<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PYearFiles extends Model
{
    protected $table = 'p_year_files';

    protected $fillable = [
        'year',
        'status',
        'locked_at',
        'created_by',
    ];

    protected $casts = [
        'locked_at' => 'date',
    ];

    /**
     * Get the user who created the year file.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope to get active year files.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get locked year files.
     */
    public function scopeLocked($query)
    {
        return $query->where('status', 'locked');
    }

    /**
     * Scope to get revise year files.
     */
    public function scopeRevise($query)
    {
        return $query->where('status', 'revise');
    }
}
