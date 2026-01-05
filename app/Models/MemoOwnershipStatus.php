<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoOwnershipStatus extends Model
{
    protected $table = 'memo_ownership_statuses';

    protected $fillable = [
        'ownership_status_name',
        'detail',
        'risk_score',
        'eqr_priority',
    ];
}
