<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaCycleSetting extends Model
{
    protected $table = "ra_cycle_settings";
    
    protected $fillable = [
        'ra_tb_mapping_id',
        'order',
        'cycle_template',
        'cycle_name',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationship to RaTbMappingSubModul
    public function tbMapping()
    {
        return $this->belongsTo(RaTbMappingSubModul::class, 'ra_tb_mapping_id');
    }

    // Relationship to job allocations
    public function jobAllocations()
    {
        return $this->hasMany(RaJobAllocation::class, 'ra_cycle_setting_id');
    }

    // Relationship to TB mappings
    public function tbMappings()
    {
        return $this->hasMany(RaTbMapping::class, 'ra_cycle_setting_id');
    }

    // Relationship to Control Risk Cycle Level
    public function controlRisk()
    {
        return $this->hasOne(RaCrCycleLvl::class, 'ra_cycle_setting_id');
    }

    // Relationship to Control Risk Account Levels
    public function accountControlRisks()
    {
        return $this->hasMany(RaCrAccountLvl::class, 'ra_cycle_setting_id');
    }
}
