<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaTbMapping extends Model
{
    protected $fillable = [
        'memo_accepted_clients_id',
        'coa',
        'account_name',
        'balance',
        'glosarium_account_elements_id',
        'ra_cycle_setting_id',
        'lead_account',
        'glosarium_lead_accounts_id',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    // Relationship to client
    public function client()
    {
        return $this->belongsTo(MemoAcceptedClient::class, 'memo_accepted_clients_id');
    }

    // Relationship to account element (Component)
    public function accountElement()
    {
        return $this->belongsTo(GlosariumAccountElement::class, 'glosarium_account_elements_id');
    }

    // Relationship to cycle setting
    public function cycleSetting()
    {
        return $this->belongsTo(RaCycleSetting::class, 'ra_cycle_setting_id');
    }

    // Relationship to lead account (Account Ref)
    public function leadAccount()
    {
        return $this->belongsTo(GlosariumLeadAccount::class, 'glosarium_lead_accounts_id');
    }

    // Relationship to Control Risk Account Levels
    public function accountControlRisks()
    {
        return $this->hasMany(RaCrAccountLvl::class, 'ra_tb_mapping_id');
    }

    // Relationship to single Account Level (for specific cycle)
    public function accountLevel()
    {
        return $this->hasOne(RaCrAccountLvl::class, 'ra_tb_mapping_id');
    }
}
