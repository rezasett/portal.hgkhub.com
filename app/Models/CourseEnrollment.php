<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'progress_percentage',
        'enrolled_at',
        'completed_at',
        'last_accessed_at',
        'total_points_earned',
        'notes',
    ];

    protected $casts = [
        'progress_percentage' => 'decimal:2',
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
        'last_accessed_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function materialCompletions(): HasMany
    {
        return $this->hasMany(CourseMaterialCompletion::class, 'user_id', 'user_id')
                    ->where('course_id', $this->course_id);
    }

    public function completedMaterials(): HasMany
    {
        return $this->hasMany(CourseMaterialCompletion::class, 'user_id', 'user_id')
                    ->whereHas('material', function($query) {
                        $query->where('course_id', $this->course_id);
                    });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Methods
    public function updateProgress()
    {
        $totalMaterials = $this->course->materials()->required()->count();
        $completedMaterials = $this->materialCompletions()->count();
        
        if ($totalMaterials > 0) {
            $progressValue = round(($completedMaterials / $totalMaterials) * 100, 2);
            $this->setAttribute('progress_percentage', $progressValue);
            
            // Mark as completed if all required materials are done
            if ($progressValue >= 100 && $this->status !== 'completed') {
                $this->status = 'completed';
                $this->completed_at = now();
            }
            
            $this->last_accessed_at = now();
            $this->save();
        }
    }

    public function updateTotalPoints()
    {
        $this->total_points_earned = $this->materialCompletions()->sum('points_earned');
        $this->save();
    }

    // Check if enrollment is active
    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    // Check if enrollment is completed
    public function getIsCompletedAttribute()
    {
        return $this->status === 'completed';
    }
}
