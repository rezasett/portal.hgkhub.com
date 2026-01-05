<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CprNegoLog extends Model
{
    protected $fillable = [
        'memo_client_prospect_data_id',
        'client_pic',
        'firm_pic',
        'negotiation_status',
        'negotiation_amount',
        'negotiation_media',
        'negotiation_date',
        'proposed_start_date',
        'proposed_end_date',
        'notes',
        'review_notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'negotiation_amount' => 'decimal:2',
        'negotiation_date' => 'date',
        'proposed_start_date' => 'date',
        'proposed_end_date' => 'date',
    ];

    public function clientProspectData(): BelongsTo
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
