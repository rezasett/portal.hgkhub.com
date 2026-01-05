<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdEqcrRecommendation extends Model
{
    protected $table = 'memo_cpd_eqcr_recommendations';

    protected $fillable = [
        'memo_client_prospect_data_id',
        'eqcr_recommendation',
    ];

    public function clientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }
}
