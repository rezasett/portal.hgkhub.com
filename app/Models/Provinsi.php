<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = "provinsis";
    protected $fillable = [
        'provinsi_indonesia',
        'risk_score',
        'eqr_priority',
    ];
}
