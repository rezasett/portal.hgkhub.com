<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpdShareholder extends Model
{
    protected $table = 'memo_cpd_shareholders';
    protected $fillable = [
        'memo_client_prospect_data_id',
        'name_shareholder',
        'percentage_ownership',
        'is_listed',
    ];

    public function clientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }
}
