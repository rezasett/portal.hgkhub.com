<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpdAuditCommittee extends Model
{
    protected $table = 'memo_cpd_audit_committees';
    protected $fillable = [
        'memo_client_prospect_data_id',
        'name_audit_committee',
        'position_audit_committee',
        'start_period',
        'end_period',
    ];

    public function clientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }
}
