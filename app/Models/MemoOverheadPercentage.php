<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoOverheadPercentage extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'percentage'
    ];
    
    protected $casts = [
        'percentage' => 'decimal:2'
    ];
}
