<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoFinancingStatus extends Model
{
    protected $table = 'memo_financing_statuses';

    protected $fillable = [
        'financing_status_name',
        'detail',
        'risk_score',
        'eqr_priority',
    ];
}
