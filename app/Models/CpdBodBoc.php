<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpdBodBoc extends Model
{
    protected $table = 'memo_cpd_bod_bocs';
    protected $fillable = [
        'memo_client_prospect_data_id',
        'name_bod_boc',
        'position_bod_boc',
        'start_period',
        'end_period',
    ];

    public function clientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }
}
