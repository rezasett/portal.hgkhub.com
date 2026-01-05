<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeLocation extends Model
{
    public function memoLevelPrices()
    {
        return $this->hasMany(MemoLevelPrice::class, 'branch_id');
    }
}
