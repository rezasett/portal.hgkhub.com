<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoEqcrRecommendationTemplate extends Model
{
    protected $fillable = [
        'risk_level',
        'score_result',
        'template_text',
        'status',
    ];
}
