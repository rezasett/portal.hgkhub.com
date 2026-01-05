<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaCycleSettingTemp extends Model
{
    protected $table = 'ra_cycle_setting_temps';
    protected $fillable = [
        'order',
        'cycle_template',
        'cycle_name',
        'status',
    ];
}
