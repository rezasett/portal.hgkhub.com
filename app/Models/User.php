<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\GlosariumIndustri;
use App\Models\UserDetail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * Relasi ke GlosariumIndustri
     */
    // relasi industri sudah didefinisikan di bawah, hapus duplikasi di sini
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'jabatan_id',
        'glosarium_industri_ids',
        'role',
        'initial',
        'status',
        'profile_photo',
        'is_online',
        'last_login_at',
        'access_urls',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'access_urls' => 'array',
        'glosarium_industri_ids' => 'array',
    ];
    
    // Accessor untuk mendapatkan koleksi industri
    public function getIndustriListAttribute()
    {
        $ids = $this->glosarium_industri_ids;
        if (is_string($ids)) {
            $ids = json_decode($ids, true) ?? [];
        }
        if (!is_array($ids)) {
            $ids = [];
        }
        return \App\Models\GlosariumIndustri::whereIn('id', $ids)->get();
    }
    /**
     * Relasi ke RoleJabatan (jabatan_id)
     */
    public function jabatan()
    {
        return $this->belongsTo(RoleJabatan::class, 'jabatan_id');
    }

    /**
     * Course relationships
     */
    public function instructedCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function courseEnrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function courseMaterialCompletions()
    {
        return $this->hasMany(CourseMaterialCompletion::class);
    }

    public function userPoints()
    {
        return $this->hasMany(UserPoint::class);
    }

    /**
     * Relation to user detail
     */
    public function detail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    /**
     * Get total points for the user
     */
    public function getTotalPointsAttribute()
    {
        return $this->userPoints()->sum('points');
    }

    /**
     * Get user's rank based on points
     */
    public function getPointsRankAttribute()
    {
        $rank = User::selectRaw('user_id, SUM(points) as total_points')
                   ->join('user_points', 'users.id', '=', 'user_points.user_id')
                   ->groupBy('user_id')
                   ->havingRaw('SUM(points) > ?', [$this->total_points])
                   ->count();
        
        return $rank + 1;
    }

    /**
     * Check if user is enrolled in a course
     */
    public function isEnrolledInCourse($courseId)
    {
        return $this->courseEnrollments()
                    ->where('course_id', $courseId)
                    ->whereIn('status', ['active', 'completed'])
                    ->exists();
    }

    /**
     * Get enrollment for specific course
     */
    public function getEnrollmentForCourse($courseId)
    {
        return $this->courseEnrollments()
                    ->where('course_id', $courseId)
                    ->first();
    }

    // ============ MEMO STATUS OVERALL RELATIONSHIPS ============

    /**
     * Status yang disave/validate oleh user ini
     */
    public function statusesSaved()
    {
        return $this->hasMany(MemoStatusOverall::class, 'saved_by');
    }

    /**
     * Status yang direview oleh user ini
     */
    public function statusesReviewed()
    {
        return $this->hasMany(MemoStatusOverall::class, 'reviewed_by');
    }

    /**
     * Status yang diapprove oleh user ini
     */
    public function statusesApproved()
    {
        return $this->hasMany(MemoStatusOverall::class, 'approve_by');
    }

    /**
     * Status yang di-QC oleh user ini
     */
    public function statusesQced()
    {
        return $this->hasMany(MemoStatusOverall::class, 'qc_by');
    }

    /**
     * Semua status yang pernah diproses user ini
     */
    public function allProcessedStatuses()
    {
        return MemoStatusOverall::where(function($query) {
            $query->where('saved_by', $this->id)
                  ->orWhere('reviewed_by', $this->id)
                  ->orWhere('approve_by', $this->id)
                  ->orWhere('qc_by', $this->id);
        });
    }
}