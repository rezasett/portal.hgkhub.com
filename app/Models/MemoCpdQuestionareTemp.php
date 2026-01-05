<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdQuestionareTemp extends Model
{ 
    protected $fillable = [
        'section',
        'questionare',
        'status',
        'risk_score',
        'eqr_priority',
        
    ];

    public function cpdQuestionareForms()
    {
        return $this->hasMany(MemoCpdQuestionareForm::class, 'memo_cpd_questionare_temp_id');
    }
}
