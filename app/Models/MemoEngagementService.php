<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoEngagementService extends Model
{

     protected $table = 'memo_engagement_services';

    protected $fillable = [
        'engagement_service_name',
        'detail',
        'risk_score',
        'eqr_priority',
    ];
}
