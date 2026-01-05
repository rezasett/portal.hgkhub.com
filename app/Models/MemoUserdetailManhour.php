<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoUserdetailManhour extends Model
{
    protected $fillable = [
        'user_detail_id',
        'level_id',
        'status',
    ];

    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }

    public function level()
    {
        return $this->belongsTo(\App\Models\MemoLevelPrice::class, 'level_id');
    }

    // Accessor untuk mendapatkan user langsung melalui userDetail
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            UserDetail::class,
            'id', // Foreign key on UserDetail table
            'id', // Foreign key on User table
            'user_detail_id', // Local key on MemoUserdetailManhour table
            'user_id' // Local key on UserDetail table
        );
    }
}
