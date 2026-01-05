<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'objectives',
        'level',
        'duration_hours',
        'thumbnail',
        'is_active',
        'is_featured',
        'status',
        'max_enrollments',
        'instructor_id',
        'category',
        'category_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relationships
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class, 'category_id');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(CourseMaterial::class)->orderBy('order_index');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    // Accessors & Mutators
    public function getTotalMaterialsAttribute()
    {
        return $this->materials()->count();
    }

    public function getTotalEnrollmentsAttribute()
    {
        return $this->enrollments()->count();
    }

    public function getAvailableSlotsAttribute()
    {
        if (!$this->max_enrollments) {
            return null;
        }
        return $this->max_enrollments - $this->total_enrollments;
    }

    public function getIsFullAttribute()
    {
        if (!$this->max_enrollments) {
            return false;
        }
        return $this->total_enrollments >= $this->max_enrollments;
    }
}
