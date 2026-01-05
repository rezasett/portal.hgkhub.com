<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCostAllocation extends Model
{
    protected $table = 'memo_cost_allocations';
    protected $fillable = [
        'memo_client_prospect_data_id',
        'memo_personel_id',
        'memo_ca_area_id',
        'q_accommodation',
        'accomodation_rate',
        'total_cost_allocation',
        'q_transport',
        'transport_rate',
        'total_cost_transport',
        'q_perdiem',
        'perdiem_rate',
        'total_cost_perdiem',
        'other_cost',
    ];

    public function personel()
    {
        return $this->belongsTo(\App\Models\MemoPersonelAllocation::class, 'memo_personel_id');
    }

    public function clientProspectData()
    {
        return $this->belongsTo(\App\Models\MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function area()
    {
        return $this->belongsTo(\App\Models\MemoCaArea::class, 'memo_ca_area_id');
    }
}
