<?php

namespace App\Models;

use App\Models\RaTbMappingSubModul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemoAcceptedClient extends Model
{
    protected $fillable = [
        'memo_client_prospect_data_id',
        'accepted_nego_log_id',
        'accepted_fee',
        'accepted_start_date',
        'accepted_end_date',
        'engagement_status',
        'actual_start_date',
        'actual_end_date',
        'completed_at',
        'completed_by',
        'completion_notes',
        'cancelled_at',
        'cancelled_by',
        'cancellation_reason',
        'accepted_by',
        'accepted_at',
        'created_by',
    ];

    protected $casts = [
        'accepted_fee' => 'decimal:2',
        'accepted_start_date' => 'date',
        'accepted_end_date' => 'date',
        'actual_start_date' => 'date',
        'actual_end_date' => 'date',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];
    
    // Relationships
    
     public function raInherentRisks()
    {
        return $this->hasMany(RaInherentRisk::class, 'memo_accepted_clients_id');
    }
    
    public function statusOveralls()
    {
        // relasi ke MemoStatusOverall berdasarkan memo_client_prospect_data_id
        return $this->hasMany(\App\Models\MemoStatusOverall::class, 'memo_client_prospect_data_id', 'memo_client_prospect_data_id');
    }
    public function tbMappingSubModuls()
    {
        return $this->hasMany(RaTbMappingSubModul::class, 'memo_acc_client_id');
    }
    public function clientProspectData(): BelongsTo
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function acceptedNegoLog(): BelongsTo
    {
        return $this->belongsTo(CprNegoLog::class, 'accepted_nego_log_id');
    }

    public function acceptedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function engagementLetters()
    {
        return $this->hasMany(EngagementLetter::class, 'memo_accepted_client_id');
    }

    public function latestEngagementLetter()
    {
        return $this->hasOne(EngagementLetter::class, 'memo_accepted_client_id')->latestOfMany();
    }

    public function tbMappings()
    {
        return $this->hasMany(RaTbMapping::class, 'memo_accepted_clients_id');
    }

    public function raMateriality()
    {
        return $this->hasOne(RaMateriality::class, 'memo_accepted_clients_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('engagement_status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('engagement_status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('engagement_status', 'cancelled');
    }
}
