<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaInherentRiskTemp extends Model
{
    public function assigns()
    {
        return $this->hasMany(RaInherentRiskAssign::class, 'ra_inherent_risk_temps_id');
    }
}
