<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemoPAStageAssign extends Model
{
     use HasFactory;
 
    protected $fillable = [
        'memo_client_prospect_data_id',
        'memo_personel_allocation_id',
        'memo_p_a_stage_temp_id',
        
        'assigned_manhour',
        'assigned_cost',

    ];

 
    public function memoClientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function memoPersonelAllocation()
    {
        return $this->belongsTo(MemoPersonelAllocation::class, 'memo_personel_allocation_id');
    }

    public function memoPAStageTemp()
    {
        return $this->belongsTo(MemoPAStageTemp::class, 'memo_p_a_stage_temp_id');
    }
}
