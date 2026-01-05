<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoPAStageTemp extends Model
{
    public function paStageAssigns()
    {
        return $this->hasMany(MemoPAStageAssign::class, 'memo_p_a_stage_temp_id');
    }
}
