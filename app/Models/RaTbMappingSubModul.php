<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaTbMappingSubModul extends Model
{
    protected $table = 'ra_tb_mapping_sub_moduls';
    
    protected $fillable = [
        'memo_acc_client_id',
        'sub_modul_audit_temp_id',
        'user_id',
        'role_assign',
    ];

    public function subModulAuditTemp()
    {
        return $this->belongsTo(RaSubModulAuditTemp::class, 'sub_modul_audit_temp_id');
    }

    public function memoAcceptedClient()
    {
        return $this->belongsTo(MemoAcceptedClient::class, 'memo_acc_client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Add: Each mapping can have many cycle settings
    public function cycleSettings()
    {
        return $this->hasMany(\App\Models\RaCycleSetting::class, 'ra_tb_mapping_id');
    }
}
