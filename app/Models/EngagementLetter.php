<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngagementLetter extends Model
{
    protected $fillable = [
        'memo_accepted_client_id',
        'letter_number',
        'letter_date',
        'letter_description',
        'file_path',
        'engagement_files',
        'auto_increment_number',
        'letter_type',
        'created_by',
    ];

    protected $casts = [
        'letter_date' => 'date',
        'engagement_files' => 'array',
    ];

    /**
     * Get the accepted client that owns the engagement letter.
     */
    public function acceptedClient()
    {
        return $this->belongsTo(MemoAcceptedClient::class, 'memo_accepted_client_id');
    }

    /**
     * Get the user who created the letter.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Extract auto increment number from letter number
     * Format: 001.01.06/ABC/HGK.HO/I-2025
     */
    public static function extractAutoIncrementFromLetterNumber($letterNumber)
    {
        if (preg_match('/^(\d+)\./', $letterNumber, $matches)) {
            return (int) $matches[1];
        }
        return 0;
    }
}
