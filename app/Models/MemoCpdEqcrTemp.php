<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdEqcrTemp extends Model
{
    protected $table = 'memo_cpd_eqcr_temps';

    protected $fillable = [
        'order',
        'title_eqcr',
        'description',
        'item',
        'scoring',
        'status',
    ];
}
