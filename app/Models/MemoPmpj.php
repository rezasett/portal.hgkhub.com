<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemoPmpj extends Model
{
    protected $fillable = [
        'memo_client_prospect_data_id',
        'bo_profile_risk',
        'business_profile_risk',
        'domicile_profile_risk'
    ];

    protected $casts = [
        'bo_profile_risk' => 'string',
        'business_profile_risk' => 'string', 
        'domicile_profile_risk' => 'string'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(MemoPmpjComment::class);
    }

    public function getRiskLevelColor($riskLevel): string
    {
        return match($riskLevel) {
            'high' => 'bg-red-100 text-red-800',
            'low' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getRiskLevelText($riskLevel): string
    {
        return match($riskLevel) {
            'high' => 'High Risk',
            'low' => 'Low Risk',
            default => 'Not Set'
        };
    }
}
