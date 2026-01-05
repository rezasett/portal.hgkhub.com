<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCaArea extends Model
{
    protected $table = 'memo_ca_areas';

    protected $fillable = [
        'order',
        'from_branch_id',
        'name_area',
        'description',
        'accomodation_rate',
        'transportation_rate',
        'perdiem_rate',
        'currency',
        'status',
    ];

    public function fromBranch()
    {
        return $this->belongsTo(OfficeLocation::class, 'from_branch_id');
    }
}
