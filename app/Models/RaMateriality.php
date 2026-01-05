<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RaMateriality extends Model
{
    protected $fillable = [
        'memo_accepted_clients_id',
        'total_assets',
        'total_liabilities',
        'total_equity',
        'total_revenue',
        'total_expenses',
        'total_ebt',
        'benchmark_selection',
        'benchmark_value',
        'om_percentage_margin',
        'om_amount',
        'om_decision_note',
        'pm_percentage_margin',
        'pm_amount',
        'pm_decision_note',
        'sud_percentage_margin',
        'sud_amount',
        'sud_decision_note',
    ];

    protected $casts = [
        'total_assets' => 'decimal:2',
        'total_liabilities' => 'decimal:2',
        'total_equity' => 'decimal:2',
        'total_revenue' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'total_ebt' => 'decimal:2',
        'benchmark_value' => 'decimal:2',
        'om_percentage_margin' => 'decimal:2',
        'om_amount' => 'decimal:2',
        'pm_percentage_margin' => 'decimal:2',
        'pm_amount' => 'decimal:2',
        'sud_percentage_margin' => 'decimal:2',
        'sud_amount' => 'decimal:2',
    ];

    /**
     * Get the accepted client that owns this materiality.
     */
    public function memoAcceptedClient(): BelongsTo
    {
        return $this->belongsTo(MemoAcceptedClient::class, 'memo_accepted_clients_id');
    }

    /**
     * Calculate OM amount based on benchmark value and percentage.
     */
    public function calculateOmAmount()
    {
        if ($this->benchmark_value && $this->om_percentage_margin) {
            $this->om_amount = (float)(($this->benchmark_value * $this->om_percentage_margin) / 100);
            return $this->om_amount;
        }
        return 0;
    }

    /**
     * Calculate PM amount based on OM amount and percentage.
     */
    public function calculatePmAmount()
    {
        if ($this->om_amount && $this->pm_percentage_margin) {
            $this->pm_amount = (float)(($this->om_amount * $this->pm_percentage_margin) / 100);
            return $this->pm_amount;
        }
        return 0;
    }

    /**
     * Calculate SUD amount based on benchmark value and percentage.
     */
    public function calculateSudAmount()
    {
        if ($this->benchmark_value && $this->sud_percentage_margin) {
            $this->sud_amount = (float)(($this->benchmark_value * $this->sud_percentage_margin) / 100);
            return $this->sud_amount;
        }
        return 0;
    }
}
