<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseMaterialCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'course_material_id',
        'completed_at',
        'points_earned',
        'score',
        'time_spent_minutes',
        'quiz_answers',
        'notes',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'score' => 'decimal:2',
        'quiz_answers' => 'array',
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

    public function material(): BelongsTo
    {
        return $this->belongsTo(CourseMaterial::class, 'course_material_id');
    }

    // Scopes
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeByMaterial($query, $materialId)
    {
        return $query->where('course_material_id', $materialId);
    }

    // Boot method to create user point record when completion is saved
    protected static function boot()
    {
        parent::boot();

        static::created(function ($completion) {
            // Create user point record
            UserPoint::create([
                'user_id' => $completion->user_id,
                'source_type' => 'course_material',
                'source_id' => $completion->course_material_id,
                'points' => $completion->points_earned,
                'description' => "Menyelesaikan materi: {$completion->material->title}",
                'earned_at' => $completion->completed_at,
            ]);

            // Update enrollment progress
            $enrollment = CourseEnrollment::where('user_id', $completion->user_id)
                ->where('course_id', $completion->course_id)
                ->first();

            if ($enrollment) {
                $enrollment->updateProgress();
                $enrollment->updateTotalPoints();
            }
        });
    }

    // Get passing status for quiz materials
    public function getIsPassingAttribute()
    {
        if ($this->material->type === 'quiz' && $this->score !== null) {
            return $this->score >= 70; // Assuming 70% is passing grade
        }
        return true; // Non-quiz materials are always passing
    }
}
