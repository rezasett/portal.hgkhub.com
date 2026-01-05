<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoPersonelAllocation extends Model
{
    protected $casts = [
        'assignment_start_date' => 'date',
        'assignment_end_date' => 'date',
    ];
    protected $fillable = [
        'memo_client_prospect_data_id',
        'personnel_manhour_id',
        'assignment_role',
        'assignment_start_date',
        'assignment_end_date',
        'working_hours',
    ];

    public function memoClientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }


    public function personnelManhour()
    {
        return $this->belongsTo(MemoUserdetailManhour::class, 'personnel_manhour_id');
    }


    public function paStageAssigns()
    {
        return $this->hasMany(MemoPAStageAssign::class, 'memo_personel_allocation_id');
    }

    public function jobAllocations()
    {
        return $this->hasMany(RaJobAllocation::class, 'memo_personel_allocation_id');
    }
}
