<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaMarginReference extends Model
{
    protected $fillable = [
        'order',
        'name',
        'type',
        'percentage',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Scope to get margin references by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type)->orderBy('order');
    }

    /**
     * Scope to get OM (Overall Materiality) references.
     */
    public function scopeOm($query)
    {
        return $query->byType('om');
    }

    /**
     * Scope to get PM (Performance Materiality) references.
     */
    public function scopePm($query)
    {
        return $query->byType('pm');
    }

    /**
     * Scope to get SUD (Summary of Unadjusted Differences) references.
     */
    public function scopeSud($query)
    {
        return $query->byType('sud');
    }
}
