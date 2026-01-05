<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaInherentRiskAssign extends Model
{
    protected $fillable = [
        'ra_inherent_risks_id',
        'ra_inherent_risk_temps_id',
        'answer',
    ];

    public function raInherentRisk()
    {
        return $this->belongsTo(RaInherentRisk::class, 'ra_inherent_risks_id');
    }

    public function raInherentRiskTemp()
    {
        return $this->belongsTo(RaInherentRiskTemp::class, 'ra_inherent_risk_temps_id');
    }
}
