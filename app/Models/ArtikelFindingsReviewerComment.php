<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelFindingsReviewerComment extends Model
{
    use HasFactory;
    protected $table = 'artikel_findings_reviewer_comments';
    protected $fillable = [
        'artikel_findings_id',
        'reviewer_id',
        'komentar',
    ];

    public function artikelFindings()
    {
        return $this->belongsTo(ArtikelFindings::class, 'artikel_findings_id');
    }
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
