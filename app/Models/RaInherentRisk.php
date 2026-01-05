<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaInherentRisk extends Model
{
    protected $fillable = [
        'memo_accepted_clients_id',
        'ra_tb_mappings_id',
        'ra_materialities_id',
        'cycle',
        'lead_account',
        'balance',
        'materiality_scoping',
        'IR_result',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'materiality_scoping' => 'decimal:2',
    ];

    public function memoAcceptedClient()
    {
        return $this->belongsTo(MemoAcceptedClient::class, 'memo_accepted_clients_id');
    }

    public function tbMapping()
    {
        return $this->belongsTo(RaTbMapping::class, 'ra_tb_mappings_id');
    }

    public function materiality()
    {
        return $this->belongsTo(RaMateriality::class, 'ra_materialities_id');
    }

    public function assigns()
    {
        return $this->hasMany(RaInherentRiskAssign::class, 'ra_inherent_risks_id');
    }
}
