<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaSubModulAuditTemp extends Model
{
    protected $fillable = [
        'order',
        'name_sub_modul_audit_temp',
        'description',
        'route_url',
        'route_name',
        'status',
    ];

    public function tbMappingSubModuls()
    {
        return $this->hasMany(RaTbMappingSubModul::class, 'sub_modul_audit_temp_id');
    }
}
