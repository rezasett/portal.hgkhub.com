<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlosariumStandarAkuntansi extends Model
{
    protected $fillable = [
        'standar_akuntansi',
        'deskripsi',
        'risk_score',
        'eqr_priority',
    ];
}
