<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpdLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'memo_client_prospect_data_id',
        'letter_number_proposal',
        'letter_date',
        'letter_description',
        'file_path_proposal',
        'auto_increment_number'
    ];

    protected $casts = [
        'letter_date' => 'date',
    ];

    /**
     * Get the client prospect data that owns the letter.
     */
    public function clientProspectData()
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
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