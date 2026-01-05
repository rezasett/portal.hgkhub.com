<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaJobAllocation extends Model
{
    protected $table = 'ra_job_allocations';
    
    protected $fillable = [
        'memo_personel_allocation_id',
        'ra_cycle_setting_id',
    ];

    public function personnelAllocation()
    {
        return $this->belongsTo(MemoPersonelAllocation::class, 'memo_personel_allocation_id');
    }

    public function cycleSetting()
    {
        return $this->belongsTo(RaCycleSetting::class, 'ra_cycle_setting_id');
    }
}
