<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class UserPointSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_points',
        'earned_today',
        'level',
        'next_level_points',
        'last_earned_date',
    ];

    protected $casts = [
        'last_earned_date' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function updateLevel()
    {
        $levelThresholds = [
            1 => 0,
            2 => 100,
            3 => 250,
            4 => 500,
            5 => 1000,
            6 => 2000,
            7 => 3500,
            8 => 5000,
            9 => 7500,
            10 => 10000,
        ];

        $newLevel = 1;
        foreach ($levelThresholds as $level => $threshold) {
            if ($this->total_points >= $threshold) {
                $newLevel = $level;
            }
        }

        $this->level = $newLevel;
        
        // Set next level points
        $nextLevelKey = $newLevel + 1;
        if (isset($levelThresholds[$nextLevelKey])) {
            $this->next_level_points = $levelThresholds[$nextLevelKey];
        } else {
            $this->next_level_points = $this->total_points + 2500; // After max level
        }

        $this->save();
    }

    public function addPoints($points, $description = null)
    {
        $this->total_points += $points;
        
        // Update today's points if it's the same day  
        if ($this->last_earned_date && $this->last_earned_date->isToday()) {
            $this->earned_today += $points;
        } else {
            $this->earned_today = $points;
            $this->last_earned_date = now();
        }

        $this->updateLevel();
        
        // Log individual point transaction
        UserPoint::create([
            'user_id' => $this->user_id,
            'source_type' => 'manual',
            'points' => $points,
            'description' => $description ?? 'Manual point addition',
            'earned_at' => now(),
        ]);

        return $this;
    }
}
