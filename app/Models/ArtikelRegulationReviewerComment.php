<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelRegulationReviewerComment extends Model
{
    use HasFactory;
    protected $table = 'artikel_reg_reviewer_comments';
    protected $fillable = [
        'artikel_regulation_id',
        'reviewer_id',
        'komentar',
    ];

    public function artikelRegulation()
    {
        return $this->belongsTo(ArtikelRegulations::class, 'artikel_regulation_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}