<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdQuestionareForm extends Model
{ 
    protected $table = "memo_cpd_questionare_forms";
    protected $fillable = [
        'memo_client_prospect_data_id',
        'memo_cpd_questionare_temp_id',
        'answer',
        'cpd_result_risk',
        'risk_score',
        'result_risk_overall',
        'notes',
    ];  
        protected $casts = [
    'answer' => 'boolean',
    ];
    public function clientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    public function questionareTemp()
    {
        return $this->belongsTo(MemoCpdQuestionareTemp::class, 'memo_cpd_questionare_temp_id');
    }
    
}
