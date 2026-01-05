<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaCrCycleLvl extends Model
{
    protected $fillable = [
        'ra_cycle_setting_id',
        'frequency',
        'walkthrough_file',
        'test_of_control_file',
        'effectiveness',
        'notes',
    ];

    /**
     * Get the RaCycleSetting that owns the RaCrCycleLvl.
     */
    public function cycleSetting()
    {
        return $this->belongsTo(RaCycleSetting::class, 'ra_cycle_setting_id');
    }
}
