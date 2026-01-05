<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EqrAssign extends Model
{
    protected $table = 'eqr_assigns';

    protected $fillable = [
        'eqr_id',
        'assigned_date',
        'start_period',
        'end_period',
        'status',
    ];

    protected $casts = [
        'assigned_date' => 'date',
    ];

    /**
     * Get the user detail that owns the EQR assignment.
     */
    public function eqr(): BelongsTo
    {
        return $this->belongsTo(UserDetail::class, 'eqr_id');
    }
}