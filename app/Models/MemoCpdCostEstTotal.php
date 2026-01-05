<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemoCpdCostEstTotal extends Model
{
    protected $fillable = [
        'memo_client_prospect_data_id',
        'risk_level',
        'total_man_hour',
        'total_cost_allocation',
        'based_price',
        'overhead_percentage',
        'total_basedprice_overhead',
        'profit_margin_percentage',
        'margin_amount',
        'fee_before_tax',
        'ppn_tax_percentage',
        'ppn_tax',
        'total_fee_after_tax',
        'estimated_client_price',
        'final_fee',
        'status',
        'created_by',
        'approved_by'
    ];

    protected $casts = [
        'total_man_hour' => 'decimal:2',
        'total_cost_allocation' => 'decimal:2',
        'based_price' => 'decimal:2',
        'overhead_percentage' => 'decimal:2',
        'total_basedprice_overhead' => 'decimal:2',
        'profit_margin_percentage' => 'decimal:2',
        'margin_amount' => 'decimal:2',
        'fee_before_tax' => 'decimal:2',
        'ppn_tax_percentage' => 'decimal:2',
        'ppn_tax' => 'decimal:2',
        'total_fee_after_tax' => 'decimal:2',
        'estimated_client_price' => 'decimal:2',
        'final_fee' => 'decimal:2',
    ];

    public function clientProspectData(): BelongsTo
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
