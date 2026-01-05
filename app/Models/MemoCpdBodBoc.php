<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoCpdBodBoc extends Model
{
    protected $fillable = [
        'questionare_form_id',
        'name_bod_boc',
        'position_bod_boc',
        'start_period',
        'end_period',
    ];

    public function questionareForm()
    {
        return $this->belongsTo(MemoCpdQuestionareForm::class, 'questionare_form_id');
    }
}
