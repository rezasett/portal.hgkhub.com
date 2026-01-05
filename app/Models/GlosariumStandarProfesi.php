<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlosariumStandarProfesi extends Model
{
    protected $table = 'glosarium_standar_profesis';
    
    protected $fillable = [
        'nama_standar_profesi',
        'description',
    ];
}
