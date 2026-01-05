<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaLibReviewerComment extends Model
{
    protected $fillable = [
        'sa_lib_id',
        'reviewer_id',
        'komentar',
    ];
}
