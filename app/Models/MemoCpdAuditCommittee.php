<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdAuditCommittee extends Model
{
    protected $fillable = [
        'questionare_form_id',
        'name_audit_committee',
        'position_audit_committee',
        'start_period',
        'end_period',
    ];

    public function questionareForm()
    {
        return $this->belongsTo(MemoCpdQuestionareForm::class, 'questionare_form_id');
    }
}
