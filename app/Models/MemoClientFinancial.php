<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoClientFinancial extends Model
{
    protected $fillable = [
        'client_id',
        'total_current_assets',
        'total_non_current_assets',
        'total_short_term_liability',
        'total_long_term_liability',
        'total_equity',
        'total_revenue',
        'total_expenses',
    ];

    public function client()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'client_id');
    }
}
