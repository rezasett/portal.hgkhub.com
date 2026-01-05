<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelProcedureReviewerComments extends Model
{
    use HasFactory;
    protected $table = 'artikel_procedure_reviewer_comments';
    
    protected $fillable = [
        'artikel_procedure_id',
        'reviewer_id',
        'komentar',
    ];

    public function artikelProcedure()
    {
        return $this->belongsTo(ArtikelProcedures::class, 'artikel_procedure_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
