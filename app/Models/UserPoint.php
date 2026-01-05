<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_type',
        'source_id',
        'points',
        'description',
        'metadata',
        'earned_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'earned_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeBySourceType($query, $sourceType)
    {
        return $query->where('source_type', $sourceType);
    }

    public function scopePositive($query)
    {
        return $query->where('points', '>', 0);
    }

    public function scopeNegative($query)
    {
        return $query->where('points', '<', 0);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('earned_at', '>=', now()->subDays($days));
    }

    // Static methods for point operations
    public static function getTotalPointsByUser($userId)
    {
        return static::where('user_id', $userId)->sum('points');
    }

    public static function getPointsByUserAndSource($userId, $sourceType)
    {
        return static::where('user_id', $userId)
                     ->where('source_type', $sourceType)
                     ->sum('points');
    }

    public static function getLeaderboard($limit = 10)
    {
        return static::selectRaw('user_id, SUM(points) as total_points')
                     ->with('user:id,name,email')
                     ->groupBy('user_id')
                     ->orderByDesc('total_points')
                     ->limit($limit)
                     ->get();
    }

    public static function addPoints($userId, $sourceType, $sourceId, $points, $description, $metadata = null)
    {
        return static::create([
            'user_id' => $userId,
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'points' => $points,
            'description' => $description,
            'metadata' => $metadata,
            'earned_at' => now(),
        ]);
    }
}
