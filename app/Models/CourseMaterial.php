<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'type',
        'file_path',
        'attachment_path',
        'video_url',
        'duration_minutes',
        'points',
        'order_index',
        'is_required',
        'is_active',
        'quiz_data',
        'description',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'quiz_data' => 'array',
    ];

    // Relationships
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function completions(): HasMany
    {
        return $this->hasMany(CourseMaterialCompletion::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }

    // Check if user has completed this material
    public function isCompletedByUser($userId)
    {
        return $this->completions()->where('user_id', $userId)->exists();
    }

    // Get completion data for specific user
    public function getCompletionByUser($userId)
    {
        return $this->completions()->where('user_id', $userId)->first();
    }

    // Get total completions count
    public function getTotalCompletionsAttribute()
    {
        return $this->completions()->count();
    }
}
