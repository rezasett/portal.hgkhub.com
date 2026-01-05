<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdShareholder extends Model
{
    protected $fillable = [
        'cpd_questionare_form_id',
        'name_shareholder',
        'percentage_ownership',
        'is_listed',
    ];

    public function questionareForm()
    {
        return $this->belongsTo(MemoCpdQuestionareForm::class, 'cpd_questionare_form_id');
    }
}
