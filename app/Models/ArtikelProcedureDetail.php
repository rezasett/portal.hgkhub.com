<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelProcedureDetail extends Model
{
    protected $table = 'artikel_procedure_details';
    
    protected $fillable = [
        'artikel_procedures_id',
        'procedure',
        'assertion_ids',
        'objective_detail',
    ];

    protected $casts = [
        'assertion_ids' => 'array',
    ];

    public function artikelProcedure()
    {
        return $this->belongsTo(ArtikelProcedures::class, 'artikel_procedures_id');
    }

    // public function assertion()
    // {
    //     return $this->belongsTo(Assertion::class, 'assertion_id');
    // }
}
