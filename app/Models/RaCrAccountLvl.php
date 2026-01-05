<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaCrAccountLvl extends Model
{
    protected $fillable = [
        'ra_tb_mapping_id',
        'ra_cycle_setting_id',
        'result_account',
        'final_result',
        'notes',
    ];

    /**
     * Get the TB Mapping that owns this control risk account level.
     */
    public function tbMapping()
    {
        return $this->belongsTo(RaTbMapping::class, 'ra_tb_mapping_id');
    }

    /**
     * Get the Cycle Setting that owns this control risk account level.
     */
    public function cycleSetting()
    {
        return $this->belongsTo(RaCycleSetting::class, 'ra_cycle_setting_id');
    }
}
