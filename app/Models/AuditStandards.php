<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditStandards extends Model
{
 
     protected $table = 'glosarium_standar_akuntansis';

    protected $fillable = [
       'standar_akuntansi',
       'deskripsi',
    ];
}
