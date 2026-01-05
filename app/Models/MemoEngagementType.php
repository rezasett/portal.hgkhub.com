<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoEngagementType extends Model
{
    protected $table = 'memo_engagement_types';

    protected $fillable = [
        'engagement_type_name',
        'detail',
        'risk_score',
        'eqr_priority',
    ];
}
