<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EducationDegree;
use App\Models\OfficeLocation;

class UserDetail extends Model
{
    /**
     * Mass assignable attributes
     *
     * @var string[]
     */

    /**
     * Relation to MemoUserdetailManhour
     */
    public function manhours()
    {
        return $this->hasMany(MemoUserdetailManhour::class, 'user_detail_id');
    }
    /**
     * Mass assignable attributes
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'education_degree_id',
        'university',
        'graduation_year',
        'date_join',
        'supervisor_id',
        'office_location_id',
        'whatsapp_number',
        'partner_number',
        'files',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'graduation_year' => 'integer',
        'date_join' => 'date',
    ];

    /**
     * Relation to user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation to education degree
     */
    public function educationDegree()
    {
        return $this->belongsTo(EducationDegree::class, 'education_degree_id');
    }

    /**
     * Relation to supervisor (user)
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Relation to office location
     */
    public function officeLocation()
    {
        return $this->belongsTo(OfficeLocation::class, 'office_location_id');
    }

    /**
     * Relation to additional certificates
     */
    public function certificates()
    {
        return $this->hasMany(\App\Models\Certificate::class, 'user_detail_id');
    }
}
