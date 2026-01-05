<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdEqcrIntScore extends Model
{
    protected $table = 'memo_cpd_eqcr_int_scores';

    protected $fillable = [
        'memo_client_prospect_data_id',
        'item',
        'internal_score',
        'result',
        'notes',
    ];

    public function eqcrTemp()
    {
        return $this->belongsTo(MemoCpdEqcrTemp::class, 'item');
    }
}
