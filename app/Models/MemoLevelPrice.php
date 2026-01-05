<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoLevelPrice extends Model
{
    protected $table = 'memo_level_prices';
    protected $fillable = [
        'order',
        'branch_id',
        'level_name',
        'description',
        'effective_date',
        'price',
        'status',
];
    public function branch()
    {
        return $this->belongsTo(OfficeLocation::class, 'branch_id');
    }
}
